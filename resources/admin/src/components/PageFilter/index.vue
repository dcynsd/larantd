<template>
  <div class="table-page-search-wrapper">
    <a-form v-if="filters.length > 0" layout="inline">
      <a-row :gutter="48">
        <template v-for="filter in filters">
          <a-col v-if="!filter.advanced || advanced" :key="filter.field" :md="4" :sm="24">
            <a-form-item>
              <a-input
                v-if="filter.type === 'input'"
                v-model="queryParam[filter.field]"
                :placeholder="`请输入 ${filter.label}`"
              />

              <a-select
                v-else-if="filter.type === 'select'"
                v-model="queryParam[filter.field]"
                :placeholder="`请选择 ${filter.label}`"
                :options="filter.options"
              />

              <a-select
                v-else-if="filter.type === 'mulselect'"
                v-model="queryParam[filter.field]"
                :placeholder="`请选择 ${filter.label}`"
                :options="filter.options"
                mode="multiple"
              />

              <a-date-picker
                style="width:100%"
                v-else-if="filter.type === 'date'"
                v-model="queryParam[filter.field]"
                valueFormat="YYYY-MM-DD"
                :placeholder="`请选择 ${filter.label}`"
              />

              <a-date-picker
                style="width:100%"
                v-else-if="filter.type === 'datetime'"
                v-model="queryParam[filter.field]"
                show-time
                valueFormat="YYYY-MM-DD HH:mm:ss"
                :placeholder="`请选择 ${filter.label}`"
              />

              <a-range-picker
                style="width:100%"
                v-else-if="filter.type === 'rangedatetime'"
                v-model="queryParam[filter.field]"
                show-time
                valueFormat="YYYY-MM-DD HH:mm:ss"
                :placeholder="[`请选择开始 ${filter.label}`, `请选择结束 ${filter.label}`]"
              />
            </a-form-item>
          </a-col>
        </template>

        <a-col :md="!advanced && 8 || 24" :sm="24">
          <span class="table-page-search-submitButtons" :style="advanced && { float: 'right', overflow: 'hidden' } || {} ">
            <a-button type="primary" @click="handleFilter">查询</a-button>
            <a-button style="margin-left: 8px" @click="resetSearchForm">重置</a-button>
            <a style="margin-left: 8px" @click="toggleAdvanced">
              {{ advanced ? '收起' : '展开' }}
              <a-icon :type="advanced ? 'up' : 'down'" />
            </a>
          </span>
        </a-col>
      </a-row>
    </a-form>

    <div v-if="showCreateBtn" class="table-operator">
      <a-button type="primary" icon="plus" @click="handleCreate">新建</a-button>
      <a-dropdown v-if="selectedRowKeys.length > 0">
        <a-menu slot="overlay">
          <a-menu-item key="1" @click="batchDestroy"><a-icon type="delete" />删除</a-menu-item>
        </a-menu>
        <a-button style="margin-left: 8px">
          批量操作 <a-icon type="down" />
        </a-button>
      </a-dropdown>
      <a-button type="primary" icon="redo" @click="handleRefresh">刷新</a-button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PageFilter',
  inject: [
    'handleFilter', 'handleCreate',
    'toggleAdvanced', 'resetSearchForm',
    'batchDestroy', 'handleRefresh'
  ],
  props: {
    queryParam: {
      type: Object,
      required: true
    },
    advanced: {
      type: Boolean,
      default: false
    },
    filters: {
      type: Array,
      default: () => []
    },
    showCreateBtn: {
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
