import pick from 'lodash.pick'

export default function (config) {
  const { fields } = config

  return {
    props: {
      visible: {
        type: Boolean,
        required: true
      },
      loading: {
        type: Boolean,
        default: () => false
      },
      model: {
        type: Object,
        default: () => null
      }
    },
    data () {
      this.formLayout = {
        labelCol: {
          xs: {
            span: 24
          },
          sm: {
            span: 7
          }
        },
        wrapperCol: {
          xs: {
            span: 24
          },
          sm: {
            span: 13
          }
        }
      }
      return {
        form: this.$form.createForm(this),
        isEdit: false
      }
    },
    created () {
      // 防止表单未注册
      fields.forEach(v => this.form.getFieldDecorator(v))
      // 当 model 发生改变时，为表单设置值
      this.$watch('model', () => {
        this.model && this.form.setFieldsValue(pick(this.model, fields))
        this.isEdit = this.model && this.model.id > 0
      })
    }
  }
}
