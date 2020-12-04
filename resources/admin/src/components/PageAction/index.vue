<template>
  <div>
    <div class="table-operator">
      <a-button v-if="createBtn" type="primary" icon="plus" @click="handleCreate">新增</a-button>
      <a-button v-if="refreshBtn" type="primary" icon="redo" @click="handleRefresh" :loading="loadingObj.refreshLoading">刷新</a-button>
      <a-dropdown v-if="selectedRowKeys.length > 0">
        <a-menu slot="overlay">
          <a-menu-item key="1" @click="batchDestroy"><a-icon type="delete" />删除</a-menu-item>
        </a-menu>
        <a-button style="margin-left: 8px">
          批量操作 <a-icon type="down" />
        </a-button>
      </a-dropdown>
    </div>

    <a-alert v-if="selectedRowKeys.length > 0" showIcon style="margin-bottom: 16px">
      <template slot="message">
        <span style="margin-right: 12px">已选择: <a style="font-weight: 600">{{ selectedRowKeys.length }}</a></span>
      </template>
    </a-alert>
  </div>
</template>

<script>
export default {
  name: 'PageAction',
  inject: [
    'handleCreate',
    'batchDestroy',
    'handleRefresh',
    'loadingObj'
  ],
  props: {
    createBtn: {
      type: Boolean,
      default: true
    },
    refreshBtn: {
      type: Boolean,
      default: true
    },
    selectedRowKeys: {
      type: Array,
      default: () => []
    }
  }
}
</script>
