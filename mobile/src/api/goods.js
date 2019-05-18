import request from '@/utils/request'

export function getGoodsListByCate(page, limit, cateId,  params = {}) {
    params.cate_id = cateId
    params.page = page
    params.limit = limit
    return request({
        url: '/goods/list',
        method: 'get',
        params: params
    })
}

export function getGoodsDetail(id) {
    return request({
        url: '/goods/' + id,
        method:'get',
    })
}

export function getGroupingList(id) {
    return request({
        url: '/goods/' + id + '/grouping',
        method: 'get',
    })
}