<template>
  <a-modal
    :title="`${isEdit ? '编辑' : '新增'}权限`"
    :width="640"
    :visible="visible"
    :confirm-loading="loading"
    @ok="() => { $emit('ok') }"
    @cancel="() => { $emit('cancel') }"
  >
    <a-spin :spinning="loading">
      <a-form :form="form" v-bind="formLayout">
        <!-- 如果是编辑，显示主键ID -->
        <a-form-item v-show="isEdit" label="主键ID">
          <a-input v-decorator="['id', { initialValue: 0 }]" disabled />
        </a-form-item>
        <a-form-item label="名称">
          <a-input v-decorator="['name', {rules: [{required: true, min: 1, message: '请输入至少一个字符的名称！'}]}]" />
        </a-form-item>
        <a-form-item label="标识">
          <a-input v-decorator="['slug', {rules: [{required: true, min: 1, message: '请输入至少一个字符的标识！'}]}]" />
        </a-form-item>
        <a-form-item label="请求方法">
          <a-select v-decorator="['http_method']" mode="multiple" allowClear>
            <a-select-option v-for="method in methods" :key="method">
              {{ method }}
            </a-select-option>
          </a-select>
        </a-form-item>
        <a-form-item label="请求地址">
          <a-textarea v-decorator="['http_path']" :rows="4" allow-clear />
        </a-form-item>
      </a-form>
    </a-spin>
  </a-modal>
</template>

<script>
import FormModalMixin from '@/layouts/mixins/FormModalMixin'

// 表单字段
const fields = ['id', 'name', 'slug', 'http_method', 'http_path']

const mixin = new FormModalMixin({
  fields: fields
})

export default {
  mixins: [mixin],
  data () {
    return {
      methods: ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD']
    }
  }
}
</script>
