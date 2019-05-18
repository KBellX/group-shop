import request from '@/utils/request'

export function loginByUsername(username, password) {
    return request({
        url: '/user/login',
        method:'post',
        data: {
            username: username,
            password: password
        },
    })
}

export function logout() {
    return request({
        url: '/user/logout',
        method: 'post'
    })
}

export function getUserInfo() {
    return request({
        url: '/user',
        method:'get'
    })
}

export function register(username, password) {
    return request({
        url: '/user/register',
        method:'post',
        data: {
            username: username,
            password: password
        },

    })
}

export function refreshToken(token, refreshToken) {
    return request({
        url: '/user/refresh_token',
        method: 'post',
        data: {
            token: token,
            refresh_token: refreshToken
        },
    })
}