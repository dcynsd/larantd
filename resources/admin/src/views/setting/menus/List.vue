<template>
  <page-header-wrapper>
    <a-card :bordered="false">

      <page-action :refresh-btn="false" />

      <s-table
        ref="table"
        row-key="id"
        :columns="columns"
        :data="loadData"
        :show-pagination="false"
      >
        <span slot="icon" slot-scope="text, row">
          <a-icon v-if="row.icon" :type="row.icon" />
        </span>

        <span slot="action" slot-scope="text, row">
          <a @click="handleEdit(row)">编辑</a>
          <a-divider type="vertical" />
          <row-destroy :id="row.id" resource="admin-menus" @ok="handleFilter" />
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
import { getMenuList, addMenu, updateMenu } from '@/api/setting/menu'
import TableBaseMixin from '@/layouts/mixins/TableBaseMixin'
import CreateForm from './Create'

const mixin = new TableBaseMixin({
  getList: getMenuList,
  add: addMenu,
  update: updateMenu
})

export default {
  name: 'MenuList',
  mixins: [mixin],
  components: {
    CreateForm
  },
  data () {
    return {
      columns: [
        {
          title: 'ID',
          dataIndex: 'id'
        },
        {
          title: '菜单唯一标识',
          dataIndex: 'name'
        },
        {
          title: '菜单标题',
          dataIndex: 'title'
        },
        {
          title: '组件映射名称',
          dataIndex: 'component'
        },
        {
          title: '图标',
          dataIndex: 'icon',
          scopedSlots: { customRender: 'icon' }
        },
        {
          title: '操作',
          dataIndex: 'action',
          width: '150px',
          scopedSlots: { customRender: 'action' }
        }
      ],
      filters: []
    }
  }
}
</script>
