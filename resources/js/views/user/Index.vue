<script setup>
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

let user = null
await axios
  .get('/api/user')
  .then((response) => {
    user = response?.data
  })
  .catch((reason) => {
    if (reason?.response?.status === 401) {
      window.location.href = '/login'
    }
  })
</script>

<template>
  <div class="flex justify-center">
    <div class="max-w-md w-full rounded overflow-hidden shadow-lg my-6 mx-4 md:mx-auto">
      <div class="font-bold text-xl px-4 pt-6 pb-2">ユーザ情報確認</div>
      <div class="flex justify-end mx-4 mb-4">
        <RouterLink
          class="text-sm underline underline-offset-4 text-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300"
          to="/user/edit"
        >
          ユーザ情報変更
        </RouterLink>
      </div>
      <div class="border-y border-gray-100">
        <dl v-if="user !== null" class="divide-y divide-gray-100">
          <div class="px-4 py-6 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">ユーザ名</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
              {{ user.name }}
            </dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">メールアドレス</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
              {{ user.email }}
            </dd>
          </div>
          <div class="px-4 py-6 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium leading-6 text-gray-900">最終ログイン日時</dt>
            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
              {{ user.last_login_at }}
            </dd>
          </div>
        </dl>
      </div>
      <div class="flex justify-center my-4">
        <button
          type="button"
          class="rounded-md bg-white border-2 px-5 py-2 text-sm shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300"
          @click="router.push('/')"
        >
          戻る
        </button>
      </div>
    </div>
  </div>
</template>
