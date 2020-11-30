<template>
  <div class="ant-pro-pages-account-projects-cardList">
    <a-list :loading="loading" :data-source="data" :grid="{ gutter: 24, xxl: 3, xl: 2, lg: 2, md: 2, sm: 2, xs: 1 }">
      <a-list-item slot="renderItem" slot-scope="item">
        <a-card class="ant-pro-pages-account-projects-card" hoverable>
          <img slot="cover" :src="item.cover" :alt="item.title" />
          <a-card-meta :title="item.title">
            <template slot="description">
              <ellipsis :length="50">{{ item.description }}</ellipsis>
            </template>
          </a-card-meta>
          <div class="cardItemContent">
            <span>{{ item.updatedAt | fromNow }}</span>
            <div class="avatarList">
              <avatar-list size="small">
                <avatar-list-item
                  v-for="(member, i) in item.members"
                  :key="`${item.id}-avatar-${i}`"
                  :src="member.avatar"
                  :tips="member.name"
                />
              </avatar-list>
            </div>
          </div>
        </a-card>
      </a-list-item>
    </a-list>
  </div>
</template>

<script>
import moment from 'moment'
import { TagSelect, StandardFormRow, Ellipsis, AvatarList } from '@/components'
const TagSelectOption = TagSelect.Option
const AvatarListItem = AvatarList.AvatarItem
export default {
  name: 'Project',
  components: {
    AvatarList,
    AvatarListItem,
    Ellipsis,
    TagSelect,
    TagSelectOption,
    StandardFormRow
  },
  data () {
    return {
      data: [],
      form: this.$form.createForm(this),
      loading: true
    }
  },
  filters: {
    fromNow (date) {
      return moment(date).fromNow()
    }
  },
  mounted () {
    this.getList()
  },
  methods: {
    handleChange (value) {
      console.log(`selected ${value}`)
    },
    getList () {
      this.data = [
        {
        id: 1,
        cover: 'https://gw.alipayobjects.com/zos/rmsportal/WdGqmHpayyMjiEhcKoVE.png',
        title: 'Alipay',
        description: '那是一种内在的东西， 他们到达不了，也无法触及的',
        status: 1,
        updatedAt: '2018-07-26 00:00:00'
        },
        {
          id: 2,
          cover: 'https://gw.alipayobjects.com/zos/rmsportal/zOsKZmFRdUtvpqCImOVY.png',
          title: 'Angular',
          description: '希望是一个好东西，也许是最好的，好东西是不会消亡的',
          status: 1,
          updatedAt: '2018-07-26 00:00:00'
        },
        {
          id: 3,
          cover: 'https://gw.alipayobjects.com/zos/rmsportal/dURIMkkrRFpPgTuzkwnB.png',
          title: 'Ant Design',
          description: '城镇中有那么多的酒馆，她却偏偏走进了我的酒馆',
          status: 1,
          updatedAt: '2018-07-26 00:00:00'
        },
        {
          id: 4,
          cover: 'https://gw.alipayobjects.com/zos/rmsportal/sfjbOqnsXXJgNCjCzDBL.png',
          title: 'Ant Design Pro',
          description: '那时候我只会想自己想要什么，从不想自己拥有什么',
          status: 1,
          updatedAt: '2018-07-26 00:00:00'
        },
        {
          id: 5,
          cover: 'https://gw.alipayobjects.com/zos/rmsportal/siCrBXXhmvTQGWPNLBow.png',
          title: 'Bootstrap',
          description: '凛冬将至',
          status: 1,
          updatedAt: '2018-07-26 00:00:00'
        },
        {
          id: 6,
          cover: 'https://gw.alipayobjects.com/zos/rmsportal/ComBAopevLwENQdKWiIn.png',
          title: 'Vue',
          description: '生命就像一盒巧克力，结果往往出人意料',
          status: 1,
          updatedAt: '2018-07-26 00:00:00'
        }
      ]
      this.loading = false
    }
  }
}
</script>

<style lang="less" scoped>
  .ant-pro-pages-account-projects-cardList {
    margin-top: 24px;
    /deep/ .ant-card-meta-title {
      margin-bottom: 4px;
    }
    /deep/ .ant-card-meta-description {
      height: 44px;
      overflow: hidden;
      line-height: 22px;
    }
    .cardItemContent {
      display: flex;
      height: 20px;
      margin-top: 16px;
      margin-bottom: -4px;
      line-height: 20px;
      > span {
        flex: 1 1;
        color: rgba(0,0,0,.45);
        font-size: 12px;
      }
      /deep/ .ant-pro-avatar-list {
        flex: 0 1 auto;
      }
    }
  }
</style>
