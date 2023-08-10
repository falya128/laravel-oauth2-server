import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'index',
      component: () => import('../views/Index.vue')
    },
    {
      path: '/user',
      name: 'user.index',
      component: () => import('../views/user/Index.vue')
    },
    {
      path: '/user/edit',
      name: 'user.edit',
      component: () => import('../views/user/Edit.vue')
    }
  ]
})
export default router
