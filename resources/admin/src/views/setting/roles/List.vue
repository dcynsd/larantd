<template>
  <page-header-wrapper>

    <page-filter :query-param="queryParam" :advanced="advanced" :filters="filters" />

    <a-card :bordered="false">

      <page-action :selected-row-keys="selectedRowKeys" />

      <s-table
        ref="table"
        row-key="id"
        :columns="columns"
        :data="loadData"
        :rowSelection="rowSelection"
      >
        <div slot="permissions" slot-scope="text, row">
          <a-tag
            color="blue"
            v-for="i of row.permissions"
            :key="i.id"
          >
            {{ i.name }}
          </a-tag>
        </div>

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
import { getRoleList, addRole, updateRole } from '@/api/setting/role'
import TableBaseMixin from '@/layouts/mixins/TableBaseMixin'
import CreateForm from './Create'

const mixin = new TableBaseMixin({
  getList: getRoleList,
  add: addRole,
  update: updateRole
})

export default {
  name: 'RoleList',
  mixins: [mixin],
  components: {
    CreateForm
  },
  data () {
    return {
      resourceName: 'admin-roles',
      columns: [
        {
          title: 'ID',
          dataIndex: 'id',
          sorter: true
        },
        {
          title: '名称',
          dataIndex: 'name'
        },
        {
          title: '标识',
          dataIndex: 'slug'
        },
        {
          title: '权限',
          dataIndex: 'permissions',
          scopedSlots: { customRender: 'permissions' }
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
          field: 'slug',
          advanced: false,
          label: '标识',
          type: 'input'
        }
      ]
    }
  },
  methods: {
    getCheckboxProps (record) {
      return {
        props: {
          disabled: record.id === 1,
          name: record.name
        }
      }
    }
  }
}
</script>
