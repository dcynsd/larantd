import request from '@/utils/request'

export function getUserList (params) {
  return request({
    url: '/admin-users',
    method: 'get',
    params: params
  })
}

export function getCreateData () {
  return request({
    url: '/admin-users/create',
    method: 'get'
  })
}

export function addUser (data) {
  return request({
    url: '/admin-users',
    method: 'post',
    data: data
  })
}

export function updateUser (id, data) {
  return request({
    url: `/admin-users/${id}`,
    method: 'put',
    data: data
  })
}
