import storage from 'store'
import { login, getMe, logout } from '@/api/auth'
import { ACCESS_TOKEN } from '@/store/mutation-types'
import { welcome } from '@/utils/util'

const auth = {
  state: {
    token: '',
    name: '',
    welcome: '',
    avatar: '',
    roles: [],
    info: {}
  },

  mutations: {
    SET_TOKEN: (state, token) => {
      state.token = token
    },
    SET_NAME: (state, { name, welcome }) => {
      state.name = name
      state.welcome = welcome
    },
    SET_AVATAR: (state, avatar) => {
      state.avatar = avatar
    },
    SET_ROLES: (state, roles) => {
      state.roles = roles
    },
    SET_INFO: (state, info) => {
      state.info = info
    }
  },

  actions: {
    // 登录
    Login ({ commit }, userInfo) {
      return new Promise((resolve, reject) => {
        login(userInfo).then(response => {
          const { token } = response
          storage.set(ACCESS_TOKEN, token, 7 * 24 * 60 * 60 * 1000)
          commit('SET_TOKEN', token)
          resolve()
        }).catch(error => {
          reject(error)
        })
      })
    },

    // 获取用户信息
    GetMe ({ commit }) {
      return new Promise((resolve, reject) => {
        getMe().then(response => {
          const { data } = response

          commit('SET_INFO', data)
          commit('SET_ROLES', data.roles)
          commit('SET_NAME', { name: data.name, welcome: welcome() })
          commit('SET_AVATAR', data.avatar)

          resolve(response)
        }).catch(error => {
          reject(error)
        })
      })
    },

    // 登出
    Logout ({ commit, state }) {
      return new Promise((resolve) => {
        logout(state.token).then(() => {
          commit('SET_TOKEN', '')
          commit('SET_ROLES', [])
          storage.remove(ACCESS_TOKEN)
          resolve()
        }).catch(() => {
          resolve()
        }).finally(() => {
        })
      })
    },

    // 刷新 token
    RefreshToken ({ commit }, token) {
      storage.set(ACCESS_TOKEN, token, 7 * 24 * 60 * 60 * 1000)
      commit('SET_TOKEN', token)
    }

  }
}

export default auth
