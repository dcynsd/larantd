import _ from 'lodash'

export default function (config) {
  const { getList, add, update } = config

  return {
    provide () {
      return {
        handleFilter: this.handleFilter,
        handleCreate: this.handleCreate,
        toggleAdvanced: this.toggleAdvanced,
        resetSearchForm: this.resetSearchForm
      }
    },
    data () {
      return {
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
        }
      }
    },
    methods: {
      toggleAdvanced () {
        this.advanced = !this.advanced
      },
      handleFilter () {
        this.$refs.table.refresh(true)
      },
      resetSearchForm () {
        this.queryParam = {}
        this.$refs.table.refresh(true)
      },
      handleCreate () {
        this.mdl = null
        this.visible = true
      },
      handleEdit (row) {
        this.visible = true
        this.mdl = { ...row }
      },
      handleCancel () {
        this.visible = false
        const form = this.$refs.createModal.form
        form.resetFields() // 清理表单数据（可不做）
      },
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
