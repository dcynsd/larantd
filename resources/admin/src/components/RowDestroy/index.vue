<template>
  <a @click="handleConfirm">
    删除
  </a>
</template>

<script>
import request from '@/utils/request'

export default {
  name: 'RowDestroy',
  props: {
    resource: {
      type: String,
      required: true
    },
    id: {
      type: Number,
      required: true
    }
  },
  methods: {
    handleConfirm () {
      this.$confirm({
        title: '你确定要删除该行？',
        okText: '确定',
        okType: 'danger',
        cancelText: '取消',
        onOk: () => {
          return request({
            url: `/${this.resource}/${this.id}`,
            method: 'delete'
          }).then(() => {
            this.$message.success('删除成功')
            this.$emit('ok')
          }).catch(() => {
            this.$message.error('删除失败')
          })
        }
      })
    }
  }
}
</script>
