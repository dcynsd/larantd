import axios from 'axios'
import store from '@/store'
import storage from 'store'
import notification from 'ant-design-vue/es/notification'
import { VueAxios } from './axios'
import { ACCESS_TOKEN } from '@/store/mutation-types'

// 创建 axios 实例
const request = axios.create({
  // API 请求的默认前缀
  baseURL: process.env.VUE_APP_API_BASE_URL,
  timeout: 6000 // 请求超时时间
})

// 异常拦截处理器
const errorHandler = (error) => {
  if (error.response) {
    const data = error.response.data

    switch (error.response.status) {
      case 403:
        notification.error({
          message: 'Forbidden',
          description: data.message
        })
        break
      case 429:
        notification.error({
          message: '请求频繁',
          description: data.message
        })
        break
      case 401:
        if (data.code === 401001) {
          notification.error({
            message: 'Unauthorized',
            description: data.message
          })
          store.dispatch('ClearToken').then(() => {
            setTimeout(() => {
              window.location.reload()
            }, 1500)
          })
        } else {
          notification.error({
            message: 'Unauthorized',
            description: 'Authorization verification failed'
          })
          store.dispatch('Logout').then(() => {
            setTimeout(() => {
              window.location.reload()
            }, 1500)
          })
        }
        break
    }
  }
  return Promise.reject(error)
}

// request interceptor
request.interceptors.request.use(config => {
  const token = storage.get(ACCESS_TOKEN)
  // 如果 token 存在
  // 让每个请求携带自定义 token 请根据实际情况自行修改
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
}, errorHandler)

// response interceptor
request.interceptors.response.use((response) => {
  const token = response.headers.authorization

  // 如果 header 中存在 token，那么触发 RefreshToken 方法，替换本地的 token
  if (token) {
    store.dispatch('RefreshToken', token)
  }

  return response.data
}, errorHandler)

const installer = {
  vm: {},
  install (Vue) {
    Vue.use(VueAxios, request)
  }
}

export default request

export {
  installer as VueAxios,
  request as axios
}
