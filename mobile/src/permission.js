import router from './router'
import { getToken } from '@/utils/auth'
import store from '@/store/index'

// 需登录才能访问的路由，保存参数，跳登录页
const whiteList = [
    '/login', '/register', '/', '/home', '/cate', '/detail' 
];

router.beforeEach((to, from, next) => {
    // console.log(from)
    // console.log(to)
    if (getToken()) {
        if (to.path == '/login' || to.path == '/register') {
            // 已登录不能跳登录页，到首页
            next({path: '/'})
        }
        next()
    } else {
        if (whiteList.indexOf(to.path) !== -1) {
            next()
        } else {
            // 判断jump status , 并置零
            let prevRoute = ''
            if (store.state.router.jumpType == 1) {
                prevRoute = to.fullPath
                store.commit('setJumpType', 0)
            } else {
                prevRoute = from.fullPath
            }
            // console.log(prevRoute)
            // 未登录不能跳需登录访问页，跳登录页
            next({path: '/login', query: {redirect: prevRoute }})      
        }
    }
})

