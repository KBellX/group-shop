import request from '@/utils/request'

export function fetchList(query) {
  return request({
    url: '/user/index',
    method: 'get',
    params: query
  })
}

