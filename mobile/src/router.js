import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/home',
      name: 'home',
      component: Home
    },
    {
      path: '/cate',
      name: 'cate',
      component: () => import('./views/cate/index.vue')
    },
    {
      path: '/detail',
      name: 'detail',
      component: () => import('./views/goods/index.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/login/index.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('./views/login/register.vue')
    },
    {
        path: '/user',
        name: 'user',
        component: () => import('./views/user/center.vue')
    },
    {
        path: '/address',
        name: 'address',
        component: () => import('./views/address/index.vue')
    },
    {
        path: '/address_edit',
        name: 'address_edit',
        component: () => import('./views/address/edit.vue')
    },
    {
        path: '/order_confirm',
        name: 'order_confirm',
        component: () => import('./views/order/confirm.vue')
    },
    {
        path: '/order_detail',
        name: 'order_detail',
        component: () => import('./views/order/detail.vue')
    },
    {
        path: '/order_list',
        name: 'order_list',
        component: () => import('./views/order/list.vue')
    },
    {
        path: '/pay',
        name: 'pay',
        component: () => import('./views/pay/pay.vue')
    },
    {
        path: '/setting',
        name: 'setting',
        component: () => import('./views/setting/index.vue')
    },
  ]
})
