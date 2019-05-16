/** When your routing table is too long, you can split it into small modules**/

import Layout from '@/views/layout/Layout'

const userRouter = {
  path: '/user',
  component: Layout,
  redirect: 'noredirect',
  name: 'User',
  alwaysShow: true,
  meta: {
    title: '用户管理',
    icon: 'chart'
  },
  children: [
    {
      path: 'user/user',
      component: () => import('@/views/user/user/list'),
      name: 'UserUser',
      meta: { title: '用户管理', noCache: true }
    }
  ]
}

export default userRouter
