<script setup>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = ref({
  name: '',
  email: ''
})

await axios
  .get('/api/user')
  .then((response) => {
    form.value = {
      name: response?.data?.name ?? '',
      email: response?.data?.email ?? ''
    }
  })
  .catch((reason) => {
    if (reason?.response?.status === 401) {
      window.location.href = '/login'
    }
  })

const errors = ref({})
const submit = async () => {
  await axios
    .post('/user', form.value)
    .then((response) => {
      router.push('/user')
    })
    .catch((reason) => {
      if (reason?.response?.status === 422) {
        errors.value = reason.response.data?.errors ?? {}
        console.log(errors.value)
      }
    })
}
</script>

<template>
  <div class="flex justify-center">
    <div class="max-w-md w-full rounded overflow-hidden shadow-lg my-6 mx-4 md:mx-auto">
      <div class="font-bold text-xl px-4 pt-6 pb-2">ユーザ情報確認</div>
      <form @submit.prevent="submit()">
        <div class="px-4 py-2">
          <label for="name" class="text-sm font-medium">ユーザ名</label>
          <div class="mt-2">
            <input
              v-model="form.name"
              id="name"
              name="name"
              type="name"
              placeholder="Test User"
              class="w-full rounded-md border-0 p-2 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:leading-6"
            />
            <div
              v-if="errors.name"
              class="bg-red-100 border border-red-400 text-red-700 px-2 py-1 mt-1 text-sm rounded relative"
              role="alert"
            >
              <div v-for="error in errors.name">{{ error }}</div>
            </div>
          </div>
        </div>
        <div class="px-4 py-2">
          <label for="email" class="text-sm font-medium">メールアドレス</label>
          <div class="mt-2">
            <input
              v-model="form.email"
              id="email"
              name="email"
              type="email"
              placeholder="test@example.com"
              class="w-full rounded-md border-0 p-2 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:leading-6"
            />
            <div
              v-if="errors.email"
              class="bg-red-100 border border-red-400 text-red-700 px-2 py-1 mt-1 text-sm rounded relative"
              role="alert"
            >
              <div v-for="error in errors.email">{{ error }}</div>
            </div>
          </div>
        </div>
        <div class="flex justify-center my-4 space-x-4">
          <button
            type="button"
            class="rounded-md bg-white border-2 px-5 py-2 text-sm shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300"
            @click="router.push('/user')"
          >
            キャンセル
          </button>
          <button
            type="submit"
            class="rounded-md bg-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
          >
            変更
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
