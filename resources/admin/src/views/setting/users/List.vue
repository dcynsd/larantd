<template>
  <page-header-wrapper>
    <a-card :bordered="false">

      <page-filter :query-param="queryParam" :advanced="advanced" :filters="filters" />

      <s-table
        ref="table"
        row-key="id"
        :columns="columns"
        :data="loadData"
      >
        <div
          slot="expandedRowRender"
          slot-scope="row"
          style="margin: 0"
        >
          <a-row
            :gutter="24"
            :style="{ marginBottom: '12px' }"
          >
            <a-col :lg="2" :md="24">
              <span>角色：</span>
            </a-col>
            <a-col v-for="role in row.roles" :key="role.id" :span="2" :style="{ marginBottom: '12px', height: '23px' }">
              <a-tag color="cyan">{{ role.name }}</a-tag>
            </a-col>
          </a-row>
          <a-row
            :gutter="24"
            :style="{ marginBottom: '12px' }"
          >
            <a-col :lg="2" :md="24">
              <span>权限：</span>
            </a-col>
            <a-col v-for="permission in row.permissions" :key="permission.id" :span="2" :style="{ marginBottom: '12px', height: '23px' }">
              <a-tag color="cyan">{{ permission.name }}</a-tag>
            </a-col>
          </a-row>
        </div>

        <span slot="avatar" slot-scope="text, row" v-viewer>
          <a-avatar :src="row.full_avatar" />
        </span>

        <span slot="action" slot-scope="text, row">
          <a v-if="row.id === 1" disabled>禁止操作</a>
          <span v-else>
            <a @click="handleEdit(row)">编辑</a>
            <a-divider type="vertical" />
            <row-destroy :id="row.id" :resource="resourceName" @ok="handleFilter" />
          </span>
        </span>
      </s-table>

      <create-form
        ref="createModal"
        :visible="visible"
        :loading="confirmLoading"
        :model="mdl"
        @cancel="handleCancel"
        @ok="handleOk"
      />

    </a-card>
  </page-header-wrapper>
</template>

<script>
import { getUserList, addUser, updateUser } from '@/api/setting/user'
import TableBaseMixin from '@/layouts/mixins/TableBaseMixin'
import CreateForm from './Create'

const mixin = new TableBaseMixin({
  getList: getUserList,
  add: addUser,
  update: updateUser
})

export default {
  name: 'UserList',
  mixins: [mixin],
  components: {
    CreateForm
  },
  data () {
    return {
      resourceName: 'admin-users',
      columns: [
        {
          title: 'ID',
          dataIndex: 'id'
        },
        {
          title: '名称',
          dataIndex: 'name'
        },
        {
          title: '账号',
          dataIndex: 'username'
        },
        {
          title: '头像',
          dataIndex: 'avatar',
          scopedSlots: { customRender: 'avatar' }
        },
        {
          title: '创建时间',
          dataIndex: 'created_at'
        },
        {
          title: '更新时间',
          dataIndex: 'updated_at'
        },
        {
          title: '操作',
          dataIndex: 'action',
          width: '150px',
          scopedSlots: { customRender: 'action' }
        }
      ],
      filters: [
        {
          field: 'name',
          advanced: false,
          label: '名称',
          type: 'input'
        },
        {
          field: 'username',
          advanced: false,
          label: '账号',
          type: 'input'
        }
      ],
      expandedRowKeys: []
    }
  },
  methods: {
    handleExpand (expanded, row) {
      if (expanded) {
        this.expandedRowKeys.push(row.id)
      } else {
        this.expandedRowKeys = this.expandedRowKeys.filter(item => row.id !== item)
      }
    }
  }
}
</script>
