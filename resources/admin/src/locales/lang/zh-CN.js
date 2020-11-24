import exceptionLang from '@/views/exception/locales/zhCN'

export default {
  app: {
    setting: {
      navigationmode: '导航模式',
      'content-width': '内容宽度',
      fixedheader: '固定头',
      fixedsidebar: '固定侧边栏',
      weakmode: '色弱模式',
      othersettings: '其它设置',
      themecolor: '主题颜色',
      pagestyle: '页面风格',
      copy: '复制配置',
      sidemenu: '侧菜单',
      topmenu: '顶部菜单',
      copyinfo: '复制成功',
    },
  },
  'app.setting.pagestyle.light': '高亮',
  'app.setting.pagestyle.dark': '暗黑',
  'app.setting.pagestyle.realdark': '全黑',
  'app.setting.themecolor.daybreak': '蓝色',
  'app.setting.themecolor.dust': '红色',
  'app.setting.themecolor.sunset': '日落色',
  'app.setting.themecolor.volcano': '火山色',
  'app.setting.themecolor.cyan': '青色',
  'app.setting.themecolor.green': '绿色',
  'app.setting.themecolor.geekblue': '极客蓝',
  'app.setting.themecolor.purple': '紫色',
  navBar: {
    lang: '语言',
  },
  layouts: {
    usermenu: {
      dialog: {
        title: '退出',
        content: '确认要退出登录吗?',
      },
    },
  },
  menu: {
    home: '首页',
    dashboard: {
      default: '仪表盘',
      welcome: '欢迎',
      workplace: '工作台',
    },
    form: {
      default: '表单页',
      basicform: '基础表单',
      stepform: '分步表单',
      advancedform: '高级表单',
    },
    nav1: '导航1',
    nav2: '导航2',
    nav3: '导航3',
  },

  pages: {
    dashboard: {
      welcome: {
        tips: '欢迎使用 Ant Design Vue',
        'show-loading': '显示 Loading',
        'hide-loading': '隐藏 Loading',
      },
    },
    form: {
      basicform: {
        headers: {
          btn1: '按钮1',
          customTitle: '自定义标题',
        },
        content: '表单页用于向用户收集或验证信息，基础表单常见于数据项较少的表单场景。',
        tabs: {
          tab1: '标签1',
          tab2: '标签2',
          tab3: '标签3',
        },
      },
    },
  },

  // page locales
  ...exceptionLang,
}
