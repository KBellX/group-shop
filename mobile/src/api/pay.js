import request from '@/utils/request'

export function payByMoney(orderId, payPassword) {
    return request({
        url: '/pay/by_money',
        method:'post',
        data: {
            order_id: orderId,
            pay_password: payPassword,
        }
    })
}