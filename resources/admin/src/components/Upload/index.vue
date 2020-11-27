<template>
  <div class="clearfix">
    <a-upload
      list-type="picture-card"
      :file-list="fileList"
      @preview="handlePreview"
      @change="handleChange"
      :customRequest="customRequest"
    >
      <div v-if="fileList.length < max">
        <a-icon type="plus" />
        <div class="ant-upload-text">
          点击上传
        </div>
      </div>
    </a-upload>
    <a-modal :visible="previewVisible" :footer="null" @cancel="handleCancel">
      <img alt="example" style="width: 100%" :src="previewImage" />
    </a-modal>
  </div>
</template>

<script>
import { addData } from '@/api/file-system'

function getBase64 (file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onload = () => resolve(reader.result)
    reader.onerror = error => reject(error)
  })
}

export default {
  props: {
    max: {
      type: Number,
      default: 7
    },
    folder: {
      type: String,
      default: 'common'
    },
    list: {
      type: Array,
      default: () => []
    }
  },
  data () {
    return {
      previewVisible: false,
      previewImage: '',
      fileList: []
    }
  },
  watch: {
    list: function (val) {
      this.fileList = val
    }
  },
  created () {
    this.fileList = this.list
  },
  methods: {
    handleCancel () {
      this.previewVisible = false
    },
    async handlePreview (file) {
      if (!file.url && !file.preview) {
        file.preview = await getBase64(file.originFileObj)
      }
      this.previewImage = file.url || file.preview
      this.previewVisible = true
    },
    handleChange ({ fileList }) {
      this.fileList = fileList
    },
    async customRequest (fileData) {
      const formData = new FormData()
      formData.append('file', fileData.file)
      formData.append('folder', this.folder)
      fileData.onProgress()

      const response = await addData(formData)

      if (response.code === 200) {
        fileData.onSuccess()
      } else {
        fileData.onError()
      }

      this.$emit('ok', { path: response.data.path })
    }
  }
}
</script>

<style>
.ant-upload-select-picture-card i {
  font-size: 32px;
  color: #999;
}

.ant-upload-select-picture-card .ant-upload-text {
  margin-top: 8px;
  color: #666;
}
</style>
