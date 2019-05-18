import request from '@/utils/request'

export function addOrder(data) {
    console.log(data)
    return request({
        url: '/order',
        method: 'post',
        data: data
    })
}

export function getOrderDetail(id) {
    return request({
        url: '/order/' + id,
        method: 'get',
    })
}

export function getOrderList(status) {
    let params = {}
    if (status != -1) {
        params = {
            status: status
        }
    }
    return request({
        url: '/order/list',
        method: 'get',
        params: params
    })
}

export function signOrder(id) {
    return request({
        url: '/order/' + id +'/sign',
        method: 'put'
    })
}
