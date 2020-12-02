import request from '@/utils/request'

export function batchDestroy (resource, data) {
  return request({
    url: `/${resource}/batch`,
    method: 'delete',
    data: data
  })
}
