<template>
  <div class="table-page-search-wrapper">
    <a-form v-if="filters.length > 0" layout="inline">
      <a-row :gutter="48">
        <template v-for="filter in filters">
          <a-col v-if="!filter.advanced || advanced" :key="filter.field" :md="6" :sm="24">
            <a-form-item :label="filter.label">
              <a-input v-if="filter.type === 'input'" v-model="queryParam[filter.field]" />

              <a-select
                v-else-if="filter.type === 'select'"
                v-model="queryParam[filter.field]"
                mode="multiple"
              >
                <a-select-option v-for="option in filter.options" :key="option.id">
                  {{ option.title }}
                </a-select-option>
              </a-select>
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
    </div>
  </div>
</template>

<script>
export default {
  name: 'PageFilter',
  inject: [
    'handleFilter', 'handleCreate',
    'toggleAdvanced', 'resetSearchForm'
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
    }
  }
}
</script>
