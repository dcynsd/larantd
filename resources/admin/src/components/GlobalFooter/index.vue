<template>
  <global-footer class="footer custom-render">
    <template v-slot:links>
      <a href="https://laravel.com" target="_blank">Laravel</a>
      <a href="https://www.github.com/vueComponent/ant-design-vue-pro" target="_blank">Ant Design Vue Pro</a>
    </template>
    <template v-slot:copyright>
      <a href="https://github.com/dcynsd" target="_blank">dcynsd</a>
    </template>
  </global-footer>
</template>

<script>
import { GlobalFooter } from '@ant-design-vue/pro-layout'

export default {
  name: 'ProGlobalFooter',
  components: {
    GlobalFooter
  }
}
</script>
