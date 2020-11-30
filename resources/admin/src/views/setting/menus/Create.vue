<template>
  <a-modal
    :title="`${isEdit ? '编辑' : '新增'}菜单`"
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
        <a-form-item label="父级菜单">
          <a-select
            v-decorator="['parent_id', {rules: [{required: true, message: '请选择父级菜单'}]}]"
            option-filter-prop="children"
            :show-search="true"
            :options="treeData"
            placeholder="请选择父级菜单"
          />
        </a-form-item>

        <a-form-item label="菜单标识">
          <a-input
            v-decorator="['name', {rules: [{required: true, min: 1, message: '请输入至少一个字符的菜单标识！'}]}]"
            placeholder="菜单唯一标识"
          />
        </a-form-item>
        <a-form-item label="菜单标题">
          <a-input
            v-decorator="['title', {rules: [{required: true, min: 1, message: '请输入至少一个字符的菜单标题！'}]}]"
            placeholder="用作显示左侧菜单标题"
          />
        </a-form-item>
        <a-form-item label="组件名称">
          <a-select
            v-decorator="['component', {rules: [{required: true, message: '请选择组件名称'}]}]"
            placeholder="请选择组件名称"
            :options="componentKeys"
          />
        </a-form-item>
        <a-form-item>
          <span slot="label">
            重定向地址&nbsp;
            <a-tooltip title="用作顶级菜单，点击面包屑跳转地址">
              <a-icon type="question-circle-o" />
            </a-tooltip>
          </span>
          <a-input v-decorator="['redirect']" placeholder="例如：/dashboard/workplace" />
        </a-form-item>
        <a-form-item>
          <span slot="label">
            路由PATH&nbsp;
            <a-tooltip title="地址栏会显示该地址">
              <a-icon type="question-circle-o" />
            </a-tooltip>
          </span>
          <a-input v-decorator="['path']" placeholder="例如：/dashboard/analysis" />
        </a-form-item>
        <a-form-item label="图标">
          <a-input v-decorator="['icon']" />

          <icon-selector v-model="currentSelectedIcon" @change="handleIconChange" />
        </a-form-item>
        <a-form-item label="排序">
          <a-input-number
            v-decorator="['order', {initialValue: 0}]"
            :min="0"
            :max="99999999"
          />
        </a-form-item>
        <a-form-item label="是否显示">
          <a-switch
            v-decorator="['is_show', { valuePropName: 'checked' }]"
            checked-children="是"
            un-checked-children="否"
          />
        </a-form-item>

        <a-form-item label="角色">
          <a-select
            v-decorator="['roles']"
            mode="multiple"
            placeholder="请选择角色"
            :options="roleData"
          />
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
import IconSelector from '@/components/IconSelector'
import FormModalMixin from '@/layouts/mixins/FormModalMixin'
import { getCreateData } from '@/api/setting/menu'
import { constantRouterComponents } from '@/router/generator-routers'
import _ from 'lodash'

// 表单字段
const fields = [
  'id', 'parent_id', 'order', 'name', 'title', 'component',
  'icon', 'redirect', 'path', 'is_show', 'roles', 'permissions'
]

const mixin = new FormModalMixin({
  fields: fields
})

export default {
  components: {
    IconSelector
  },
  mixins: [mixin],
  data () {
    return {
      currentSelectedIcon: '',
      permissionData: [],
      roleData: [],
      treeData: [],
      targetKeys: [],
      componentKeys: []
    }
  },
  created () {
    this.componentKeys = _.map(constantRouterComponents, (item, key) => {
      return { label: key, value: key }
    })
    this.initCreateData()

    this.$watch('model', () => {
      this.isEdit = this.model && this.model.id > 0
      if (this.isEdit) {
        const roles = []
        this.model.roles.forEach(item => {
          roles.push(item.id)
        })
        this.model.roles = roles

        const targetKeys = []
        this.model.permissions.forEach(item => {
          targetKeys.push(item.id.toString())
        })
        this.targetKeys = targetKeys
      }

      this.model && this.form.setFieldsValue(pick(this.model, fields))
    })
  },
  methods: {
    async initCreateData () {
      const { data } = await getCreateData()
      this.permissionData = data.permissions.map(i => ({ key: i.id.toString(), title: i.name }))
      this.roleData = data.roles.map(i => ({ label: i.name, value: i.id }))
      this.treeData = data.parent_tree
    },
    handleChange (targetKeys, direction, moveKeys) {
      this.targetKeys = targetKeys
    },
    handleIconChange (icon) {
      this.form.setFieldsValue({ icon: icon })
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
