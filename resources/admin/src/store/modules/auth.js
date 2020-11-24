import storage from 'store'
import { login, getMe, logout } from '@/api/auth/login'
import { ACCESS_TOKEN } from '@/store/mutation-types'

const auth = {
  state: {
    token: '',
    name: '',
    welcome: '',
    avatar: '',
    roles: [],
    info: {},
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
    },
  },

  actions: {
    // 登录
    Login ({ commit }, userInfo) {
      return new Promise((resolve, reject) => {
        login(userInfo).then(response => {
          const { token } = response
          storage.set(ACCESS_TOKEN, token)
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
          // if (response.role && response.role.permissions.length > 0) {
          //   const role = response.role
          //   role.permissions = response.role.permissions
          //   role.permissions.map(per => {
          //     if (per.actionEntitySet != null && per.actionEntitySet.length > 0) {
          //       const action = per.actionEntitySet.map(action => { return action.action })
          //       per.actionList = action
          //     }
          //   })
          //   role.permissionList = role.permissions.map(permission => { return permission.permissionId })
          //   commit('SET_ROLES', response.role)
          //   commit('SET_INFO', response)
          // } else {
          //   reject(new Error('getInfo: roles must be a non-null array !'))
          // }

          commit('SET_INFO', data)
          commit('SET_NAME', { name: data.name, welcome: '' })
          commit('SET_AVATAR', data.avatar)

          resolve(response)
        }).catch(error => {
          reject(error)
        })
      })
    },

    // 登出
    Logout ({ commit }) {
      return new Promise((resolve) => {
        logout().then(() => {
          resolve()
        }).catch(() => {
          resolve()
        }).finally(() => {
          commit('SET_TOKEN', '')
          commit('SET_ROLES', [])
          storage.remove(ACCESS_TOKEN)
        })
      })
    },

    // 刷新 token
    RefreshToken({ commit }, token) {
      storage.set(ACCESS_TOKEN, token)
      commit('SET_TOKEN', token)
    }

  },
}

export default auth
