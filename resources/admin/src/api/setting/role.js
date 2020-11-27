import request from '@/utils/request'

export function getRoleList (params) {
  return request({
    url: '/admin-roles',
    method: 'get',
    params: params
  })
}

export function getCreateData () {
  return request({
    url: '/admin-roles/create',
    method: 'get'
  })
}

export function addRole (data) {
  return request({
    url: '/admin-roles',
    method: 'post',
    data: data
  })
}

export function updateRole (id, data) {
  return request({
    url: `/admin-roles/${id}`,
    method: 'put',
    data: data
  })
}
