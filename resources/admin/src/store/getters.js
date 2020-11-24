const getters = {
  isMobile: state => state.app.isMobile,
  lang: state => state.app.lang,
  theme: state => state.app.theme,
  color: state => state.app.color,
  token: state => state.auth.token,
  avatar: state => state.auth.avatar,
  nickname: state => state.auth.name,
  welcome: state => state.auth.welcome,
  roles: state => state.auth.roles,
  currentUser: state => state.auth.info,
  addRouters: state => state.permission.addRouters,
  multiTab: state => state.app.multiTab,
}

export default getters
