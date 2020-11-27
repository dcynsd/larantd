import request from '@/utils/request'

export function addData (data) {
  return request({
    url: '/file-systems',
    method: 'post',
    data: data
  })
}
