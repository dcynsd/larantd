import antd from 'ant-design-vue/es/locale-provider/zh_CN'
import momentCN from 'moment/locale/zh-cn'

const components = {
  antLocale: antd,
  momentName: 'zh-cn',
  momentLocale: momentCN
}

const locale = {
  'message': '-',
  'menu.home': '主页',
  'menu.dashboard': '仪表盘',
  'menu.dashboard.analysis': '分析页',
  'menu.dashboard.monitor': '监控页',
  'menu.dashboard.workplace': '工作台',

  'layouts.usermenu.dialog.title': '提示',
  'layouts.usermenu.dialog.content': '确认退出登录吗？',

  'app.setting.pagestyle': '页面风格',
  'app.setting.pagestyle.light': '亮色',
  'app.setting.pagestyle.dark': '暗色',
  'app.setting.pagestyle.realdark': '全黑',
  'app.setting.themecolor': '主题色',
  'app.setting.navigationmode': '导航模式（可能需要重新刷新页面）',
  'app.setting.content-width': '内容区域宽度',
  'app.setting.fixedheader': '固定头部',
  'app.setting.fixedsidebar': '固定侧边栏',
  'app.setting.sidemenu': '侧边栏导航',
  'app.setting.topmenu': '顶部导航',
  'app.setting.content-width.fixed': '固定',
  'app.setting.content-width.fluid': '流式',
  'app.setting.othersettings': '其它设置',
  'app.setting.weakmode': '色弱模式',
  'app.setting.copy': '复制配置',
  'app.setting.loading': '加载主题',
  'app.setting.copyinfo': '复制成功，请替换 src/models/setting.js 文件的默认配置',
  'app.setting.production.hint': '配置菜单只能在开发模式显示',

  'app.setting.themecolor.dust': '薄暮',
  'app.setting.themecolor.volcano': '火山',
  'app.setting.themecolor.sunset': '日暮',
  'app.setting.themecolor.cyan': '明青',
  'app.setting.themecolor.green': '极光绿',
  'app.setting.themecolor.daybreak': '拂晓蓝（默认）',
  'app.setting.themecolor.geekblue': '极客蓝',
  'app.setting.themecolor.purple': '酱紫'
}

export default {
  ...components,
  ...locale
}
