import request from '@/utils/request'

export function getMenuList (params) {
  return request({
    url: '/admin-menus',
    method: 'get',
    params: params
  })
}

export function getCreateData () {
  return request({
    url: '/admin-menus/create',
    method: 'get'
  })
}

export function addMenu (data) {
  return request({
    url: '/admin-menus',
    method: 'post',
    data: data
  })
}

export function updateMenu (id, data) {
  return request({
    url: `/admin-menus/${id}`,
    method: 'put',
    data: data
  })
}
