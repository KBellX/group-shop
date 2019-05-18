import {getStorage, setStorage, removeStorage} from "@/utils/localStorage"
import { refreshToken } from '@/api/user';
import store from '@/store/index'

const tokenKey = 'token'
const refreshTokenKey = 'refresh_token'

export function getToken() {
    return getStorage(tokenKey);
}

export function setToken(token) {
    return setStorage(tokenKey, token)
}

export function removeToken() {
    return removeStorage(tokenKey)
}

export function setRefreshToken(token) {
    return setStorage(refreshTokenKey, token)
}

export function getRefreshToken() {
    return getStorage(refreshTokenKey);
}

export function removeRefreshToken() {
    return removeStorage(refreshTokenKey)
}

export function doRefreshToken() {
    return new Promise(resolve => {
        if (!store.state.user.isDoRefreshToken) {
            // 加锁
            store.commit('setIsDoRefreshToken', true)
            // 请求刷新token接口 
            refreshToken(getToken(), getRefreshToken()).then( res => {
                // 设置token与刷新token
                setToken(res.token)
                setRefreshToken(res.refresh_token)
                // 解锁
                store.commit('setIsDoRefreshToken', false)
                resolve()
            })
        }
    })

}