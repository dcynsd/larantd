import request from '@/utils/request'

export function login (data) {
  return request({
    url: '/authorizations',
    method: 'post',
    data: data
  })
}

export function getMe () {
  return request({
    url: '/authorizations/me',
    method: 'get'
  })
}

export function updateMe (data) {
  return request({
    url: '/authorizations/me',
    method: 'put',
    data: data
  })
}

export function getMenu () {
  return request({
    url: '/authorizations/menus',
    method: 'get'
  })
}

export function logout () {
  return request({
    url: '/authorizations',
    method: 'delete'
  })
}
