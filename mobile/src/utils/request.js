import axios from 'axios'
import { Toast } from 'vant';
import { getToken } from '@/utils/auth';
import store from '@/store/index'
import {doRefreshToken, removeToken, removeRefreshToken} from '@/utils/auth'
import router from '@/router'

const service = axios.create({
    baseURL:process.env.VUE_APP_BASE_API,
    timeout:5000,
})

  // request interceptor
  service.interceptors.request.use(
    config => {
      // Do something before request is sent
      const token = getToken()
      if (token) {
          config.headers['token'] = token
      }
      // showLoading
      store.commit('showLoading', true)

      return config
    },  
    error => {
      // Do something with request error
      console.log(error) // for debug
      Promise.reject(error)
    }
  )
  
  // response interceptor
  service.interceptors.response.use(
    response => {
        // closeLoading
        store.commit('showLoading', false)
        const res = response
        // console.log(res)
        const code = res.data.code
        if (code != 0) {
            // 统一弹出异常信息和处理异常，这样外层调用，只需处理正常情况
            Toast(res.data.msg)
            // 处理token过期
            if (code == 3001) {
                doRefreshToken().then(() => {
                    // 刷新token成功，重新进入页面, 携带参数
                    router.go(0)
                    /*
                    store.commit('setIsRouterAlive', false)
                    store.commit('setIsRouterAlive', true)
                    */
                })
            }
            // token无效，清除之
            if (code == 3002 || code == 3003 || code == 4000 ) {
                removeToken()
                removeRefreshToken()
                // 设置jump status为 请求token无效
                // store.commit('setJumpType', 1)
                // window.location.reload()
                // router.go(0)
            }
            return Promise.reject('error')
        } else {
            // 正常情况：外层只需处理res.data.data的数据
            return res.data.data
        }
    },
    error => {
        console.log('error:' + error)
        Toast(error)
        return Promise.reject(error)
    }
  )

export default service