import { UserLayout } from '@/layouts'

const RouteView = {
  name: 'RouteView',
  render: (h) => h('router-view'),
}

export const constantRouterMap = [
  {
    path: '/auth',
    name: 'auth',
    component: UserLayout,
    children: [
      {
        path: '/auth/login',
        name: 'login',
        component: () => import('@/views/auth/Login'),
      },
    ],
  },
  {
    path: '/404',
    component: () => import(/* webpackChunkName: "fail" */ '@/views/exception/404'),
  },
]
