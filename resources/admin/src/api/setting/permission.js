import request from '@/utils/request'

export function getPermissionList (params) {
  return request({
    url: '/admin-permissions',
    method: 'get',
    params: params
  })
}

export function addPermission (data) {
  return request({
    url: '/admin-permissions',
    method: 'post',
    data: data
  })
}

export function updatePermission (id, data) {
  return request({
    url: `/admin-permissions/${id}`,
    method: 'put',
    data: data
  })
}
