<template>
  <a-modal
    :title="`${isEdit ? '编辑' : '新增'}角色`"
    :width="1000"
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
        <a-form-item label="权限">
          <a-transfer
            v-decorator="['permissions']"
            :titles="['待选', '已选']"
            :data-source="permissionData"
            :target-keys="targetKeys"
            show-search
            :render="item => item.title"
            @change="handleChange"
          />
        </a-form-item>
      </a-form>
    </a-spin>
  </a-modal>
</template>

<script>
import pick from 'lodash.pick'
import FormModalMixin from '@/layouts/mixins/FormModalMixin'
import { getCreateData } from '@/api/setting/role'

// 表单字段
const fields = ['id', 'name', 'slug', 'permissions']

const mixin = new FormModalMixin({
  fields: fields
})

export default {
  mixins: [mixin],
  data () {
    return {
      permissionData: [],
      targetKeys: []
    }
  },
  created () {
    this.initCreateData()

    // 防止表单未注册
    fields.forEach(v => this.form.getFieldDecorator(v))
    // 当 model 发生改变时，为表单设置值
    this.$watch('model', () => {
      this.targetKeys = []
      this.model && this.form.setFieldsValue(pick(this.model, fields))
      this.isEdit = this.model && this.model.id > 0
      const targetKeys = []
      if (this.isEdit) {
        this.model.permissions.forEach(item => {
          targetKeys.push(item.id.toString())
        })
        this.targetKeys = targetKeys
      }
    })
  },
  methods: {
    async initCreateData () {
      const { data } = await getCreateData()
      this.permissionData = data.map(i => ({ key: i.id.toString(), title: i.name }))
    },
    handleChange (targetKeys, direction, moveKeys) {
      this.targetKeys = targetKeys
    }
  }
}
</script>

<style scoped lang="less">
.ant-transfer {
  display: flex;
  align-items: center;
  ::v-deep {
    .ant-transfer-list {
      flex-grow: 1;
    }
  }
}
@media (max-width: 768px) {
  .ant-transfer {
    flex-direction: column;
    ::v-deep {
      .ant-transfer-list {
        width: 100%;
      }
      .ant-transfer-operation {
        display: flex;
        align-items: center;
        margin: 8px;
        > button {
          transform: rotate(90deg);
          margin: 0;
          + button {
            margin-left: 8px;
          }
        }
      }
    }
  }
}
</style>
