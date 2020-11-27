<template>
  <a-modal
    :title="`${isEdit ? '编辑' : '新增'}管理员`"
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
        <a-form-item label="账号">
          <a-input v-decorator="['username', {rules: [{required: true, min: 1, message: '请输入至少一个字符的账号！'}]}]" />
        </a-form-item>
        <a-form-item label="头像">
          <upload
            v-decorator="['avatar']"
            :max="1"
            folder="avatars"
            :list="fileList"
            @ok="handleUploadOk"
          />
        </a-form-item>
        <a-form-item label="密码">
          <a-input
            v-decorator="[
              'password',
              {
                rules: [
                  {required: isEdit ? false: true, min: 5, message: '请输入至少五个字符的密码！'},
                  {
                    validator: validateToNextPassword,
                  },
                ]
              }
            ]"
            type="password"
          />
        </a-form-item>
        <a-form-item label="确认密码">
          <a-input
            v-decorator="[
              'password_confirmation',
              {
                rules: [
                  {required: isEdit ? false : true, message: '请再次输入密码'},
                  {
                    validator: compareToFirstPassword,
                  },
                ]
              }
            ]"
            type="password"
          />
        </a-form-item>
        <a-form-item label="角色">
          <a-select
            v-decorator="[
              'roles',
              {
                rules: [
                  { required: true, message: '请选择至少一个角色', type: 'array' },
                ],
              },
            ]"
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
import FormModalMixin from '@/layouts/mixins/FormModalMixin'
import { getCreateData } from '@/api/setting/user'
import Upload from '@/components/Upload'

// 表单字段
const fields = ['id', 'name', 'username', 'avatar', 'password', 'password_confirmation', 'roles', 'permissions']

const mixin = new FormModalMixin({
  fields: fields
})

export default {
  mixins: [mixin],
  components: {
    Upload
  },
  data () {
    return {
      permissionData: [],
      targetKeys: [],
      roleData: [],
      fileList: []
    }
  },
  created () {
    this.initCreateData()

    // 防止表单未注册
    fields.forEach(v => this.form.getFieldDecorator(v))
    // 当 model 发生改变时，为表单设置值
    this.$watch('model', () => {
      this.targetKeys = []
      this.fileList = []

      this.isEdit = this.model && this.model.id > 0

      if (this.isEdit) {
        const targetKeys = []
        const roles = []
        this.model.permissions.forEach(item => {
          targetKeys.push(item.id.toString())
        })
        this.targetKeys = targetKeys
        this.model.roles.forEach(item => {
          roles.push(item.id)
        })
        this.model.roles = roles
        this.fileList.push({
          uid: '-1',
          name: 'avatar.png',
          status: 'done',
          url: this.model.full_avatar
        })
      }

      this.model && this.form.setFieldsValue(pick(this.model, fields))
    })
  },
  methods: {
    async initCreateData () {
      const { data } = await getCreateData()
      this.permissionData = data.permissions.map(i => ({ key: i.id.toString(), title: i.name }))
      this.roleData = data.roles.map(i => ({ label: i.name, value: i.id }))
    },
    handleChange (targetKeys, direction, moveKeys) {
      this.targetKeys = targetKeys
    },
    validateToNextPassword (rule, value, callback) {
      const form = this.form
      if (value && this.confirmDirty) {
        form.validateFields(['password_confirmation'], { force: true })
      }
      callback()
    },
    compareToFirstPassword (rule, value, callback) {
      const form = this.form
      if (value && value !== form.getFieldValue('password')) {
        // eslint-disable-next-line standard/no-callback-literal
        callback('两次输入密码不一致')
      } else {
        callback()
      }
    },
    handleUploadOk (res) {
      this.form.setFieldsValue({ avatar: res.path })
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
