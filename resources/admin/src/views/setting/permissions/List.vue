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
        <div slot="http_method" slot-scope="text, row">
          <a-tag v-if="checkIsEmpty(row.http_method)" color="blue">
            ANY
          </a-tag>
          <a-tag
            v-else
            color="blue"
            v-for="i of row.http_method"
            :key="i"
          >
            {{ i }}
          </a-tag>
        </div>

        <div slot="http_path" slot-scope="text, row">
          <div class="mb-1" v-for="(item, index) of row.http_path" :key="index">
            <code>{{ '/admin-api' + item }}</code>
          </div>
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
import { getPermissionList, addPermission, updatePermission } from '@/api/setting/permission'
import TableBaseMixin from '@/layouts/mixins/TableBaseMixin'
import CreateForm from './Create'
import _ from 'lodash'

const mixin = new TableBaseMixin({
  getList: getPermissionList,
  add: addPermission,
  update: updatePermission
})

export default {
  name: 'PermissionList',
  mixins: [mixin],
  components: {
    CreateForm
  },
  data () {
    return {
      resourceName: 'admin-permissions',
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
          title: '请求方法',
          dataIndex: 'http_method',
          scopedSlots: { customRender: 'http_method' }
        },
        {
          title: '请求地址',
          dataIndex: 'http_path',
          scopedSlots: { customRender: 'http_path' }
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
          field: 'id',
          advanced: false,
          label: 'ID',
          type: 'input'
        },
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
        },
        {
          field: 'http_method',
          advanced: true,
          label: '请求方法',
          type: 'input'
        },
        {
          field: 'http_path',
          advanced: true,
          label: '请求地址',
          type: 'input'
        },
        {
          field: 'created_at',
          advanced: true,
          label: '创建时间',
          type: 'rangedatetime'
        }, {
          field: 'updated_at',
          advanced: true,
          label: '更新时间',
          type: 'datetime'
        }
      ]
    }
  },
  methods: {
    handleEdit (row) {
      this.visible = true
      const newRow = JSON.parse(JSON.stringify(row))
      if (!this.checkIsEmpty(newRow.http_path)) {
        newRow.http_path = newRow.http_path.join('\n')
      }
      if (this.checkIsEmpty(newRow.http_method)) {
        newRow.http_method = []
      }
      this.mdl = { ...newRow }
    },
    checkIsEmpty (value) {
      return _.isEmpty(value)
    },
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
