<script setup>
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()

let name = ''
await axios
  .get('/api/user')
  .then((response) => {
    name = response?.data?.name
  })
  .catch((reason) => {
    if (reason?.response?.status === 401) {
      window.location.href = '/login'
    }
  })

const logout = async () => {
  await axios.post('/logout').then((response) => {
    window.location.href = '/login'
  })
}
</script>

<template>
  <div class="text-center px-6 py-24">
    <div class="text-4xl font-bold">ようこそ、<br class="sm:hidden" />{{ name }} さん</div>
    <div class="mt-16 flex items-center justify-center space-x-5">
      <button
        type="button"
        class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        @click="logout()"
      >
        ログアウト
      </button>
      <button
        type="button"
        class="rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
        @click="router.push('/user')"
      >
        ユーザ情報確認
      </button>
    </div>
  </div>
</template>
