import _ from 'lodash'
import { batchDestroy } from '@/api/common'

export default function (config) {
  const { getList, add, update } = config

  return {
    provide () {
      return {
        handleFilter: this.handleFilter,
        handleCreate: this.handleCreate,
        toggleAdvanced: this.toggleAdvanced,
        resetSearchForm: this.resetSearchForm,
        batchDestroy: this.batchDestroy,
        handleRefresh: this.handleRefresh,
        loadingObj: this.loadingObj
      }
    },
    data () {
      return {
        // 资源名称
        resourceName: '',
        // create model
        visible: false,
        confirmLoading: false,
        mdl: null,
        // 高级搜索 展开/关闭
        advanced: false,
        // 查询参数
        queryParam: {},
        // 自定义表格 alert & rowSelection
        options: {},
        meta: {},
        // 加载数据方法 必须为 Promise 对象
        loadData: parameter => {
          return getList(Object.assign({}, parameter, this.queryParam))
            .then(res => {
              this.meta = res.data.meta
              return res.data
            })
        },
        selectedRowKeys: [],
        selectedRows: [],
        loadingObj: {
          refreshLoading: false
        }
      }
    },
    computed: {
      rowSelection () {
        return {
          selectedRowKeys: this.selectedRowKeys,
          onChange: this.onSelectChange,
          getCheckboxProps: this.getCheckboxProps
        }
      }
    },
    watch: {
      $route: {
        handler () {
          // 监听路由变化，并设置参数请求
          this.setFormValueFromQuery()
        },
        immediate: true
      }
    },
    methods: {
      // 行选择事件
      onSelectChange (selectedRowKeys, selectedRows) {
        this.selectedRowKeys = selectedRowKeys
        this.selectedRows = selectedRows
      },
      // 获取多选处理
      getCheckboxProps (record) {
        return {
          props: {
            name: record.name
          }
        }
      },
      // 批量删除
      batchDestroy () {
        if (!this.resourceName) {
          this.$message.error('请配置资源名称')
          return
        }

        if (this.selectedRowKeys.length === 0) {
          this.$message.error('请选择')
          return
        }

        this.$confirm({
          title: '你确定要批量删除数据？',
          okText: '确定',
          okType: 'danger',
          cancelText: '取消',
          onOk: () => {
            return batchDestroy(this.resourceName, { ids: this.selectedRowKeys }).then(() => {
              this.$message.success('删除成功')
              this.selectedRowKeys = []
              this.selectedRows =
              this.$refs.table.refresh(true)
            }).catch(() => {
              this.$message.error('删除失败')
            })
          }
        })
      },
      // 点击展开事件
      toggleAdvanced () {
        this.advanced = !this.advanced
      },
      // 点击查询按钮筛选事件
      handleFilter () {
        const query = {}
        _.forEach(this.queryParam, (val, key) => {
          if (typeof val === 'string') {
            val = val.trim()
          }
          if (val !== '' && val !== undefined) {
            query[key] = val
          }
        })

        this.$router.push({
          path: this.$route.path,
          query
        })
      },
      // 从地址栏获取并设置请求参数
      setFormValueFromQuery () {
        const query = this.$route.query

         _.forEach(query, (val, key) => {
          val = query[key]
          this.$set(this.queryParam, key, val)
        })

        this.$nextTick(() => {
          this.$refs.table.refresh(true)
        })
      },
      // 处理刷新按钮事件
      handleRefresh () {
        this.loadingObj.refreshLoading = true
        this.$refs.table.refresh()
        setTimeout(() => {
          this.loadingObj.refreshLoading = false
        }, 500)
      },
      // 重置筛选表单
      resetSearchForm () {
        this.queryParam = {}

        this.$router.push({
          path: this.$route.path
        })
      },
      // 处理新增按钮事件
      handleCreate () {
        this.mdl = null
        this.visible = true
      },
      // 处理行编辑事件
      handleEdit (row) {
        this.visible = true
        this.mdl = { ...row }
      },
      // 处理表单模态框取消事件
      handleCancel () {
        this.visible = false
        const form = this.$refs.createModal.form
        form.resetFields() // 清理表单数据（可不做）
      },
      // 处理表单模态框新增或者修改事件
      handleOk () {
        const form = this.$refs.createModal.form
        this.confirmLoading = true
        form.validateFields((errors, values) => {
          if (!errors) {
            if (values.id > 0) {
              // 修改 e.g.
              update(values.id, values).then(() => {
                this.visible = false
                this.confirmLoading = false
                form.resetFields()
                this.$refs.table.refresh()
                this.$message.success('修改成功')
              }).catch(err => {
                const { code, error } = err.response.data

                if (code === 422) {
                  _.forEach(error, (item, index) => {
                    form.setFields({
                      [index]: {
                        value: values[index],
                        errors: [
                          { message: item[0], field: index }
                        ]
                      }
                    })
                  })
                }

                this.confirmLoading = false
              })
            } else {
              // 新增
              add(values).then(() => {
                this.visible = false
                this.confirmLoading = false
                form.resetFields()
                this.$refs.table.refresh()
                this.$message.success('新增成功')
              }).catch(err => {
                const { code, error } = err.response.data

                if (code === 422) {
                  _.forEach(error, (item, index) => {
                    form.setFields({
                      [index]: {
                        value: values[index],
                        errors: [
                          { message: item[0], field: index }
                        ]
                      }
                    })
                  })
                }

                this.confirmLoading = false
              })
            }
          } else {
            this.confirmLoading = false
          }
        })
      }
    }
  }
}
