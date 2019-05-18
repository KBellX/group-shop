import request from '@/utils/request'

export function getAddressList(){
    return request({
        url: '/address/list',
        method: 'get'
    })
}

export function getAddressDetail(id){
    return request({
        url: '/address/' + id,
        method: 'get'
    })
}

export function addAddress(data) {
    return request({
        url: '/address',
        method:'post',
        data: data
    })
}

export function editAddress(id, data) {
    return request({
        url: '/address/' + id,
        method: 'put',
        data: data
    })
}

export function deleteAddress(id) {
    return request({
        url: '/address/' + id,
        method: 'delete',
    })
}

export function getDefaultAddress() {
    return request({
        url: '/address/default',
        method:'get'
    })
}