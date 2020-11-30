<template>
  <a-list
    size="large"
    rowKey="id"
    :loading="loading"
    itemLayout="vertical"
    :dataSource="data"
  >
    <a-list-item :key="item.id" slot="renderItem" slot-scope="item">
      <template slot="actions">
        <icon-text type="star-o" :text="item.star" />
        <icon-text type="like-o" :text="item.like" />
        <icon-text type="message" :text="item.message" />
      </template>
      <a-list-item-meta>
        <a slot="title" href="https://vue.ant.design/">{{ item.title }}</a>
        <template slot="description">
          <span>
            <a-tag>Ant Design</a-tag>
            <a-tag>设计语言</a-tag>
            <a-tag>蚂蚁金服</a-tag>
          </span>
        </template>
      </a-list-item-meta>
      <article-list-content :description="item.description" :owner="item.owner" :avatar="item.avatar" :href="item.href" :updateAt="item.updatedAt" />
    </a-list-item>
    <div slot="footer" v-if="data.length > 0" style="text-align: center; margin-top: 16px;">
      <a-button @click="loadMore" :loading="loadingMore">加载更多</a-button>
    </div>
  </a-list>
</template>

<script>
import { ArticleListContent } from '@/components'
import IconText from '@/components/IconText'
export default {
  name: 'Article',
  components: {
    IconText,
    ArticleListContent
  },
  data () {
    return {
      loading: true,
      loadingMore: false,
      data: [],
      start: 0,
      count: 10
    }
  },
  mounted () {
    this.getList()
  },
  methods: {
    loadMore () {
      this.start = this.count
      this.count += 10
      this.loadingMore = true
      setTimeout(() => {
        this.data = this.data.concat(this.getData())
        this.loadingMore = false
      }, 1000)
    },
    getList () {
      this.data = this.getData()
      this.loading = false
    },

    getData () {
      const titles = [
        'Alipay',
        'Angular',
        'Ant Design',
        'Ant Design Pro',
        'Bootstrap',
        'React',
        'Vue',
        'Webpack'
      ]

      const avatar = ['https://gw.alipayobjects.com/zos/rmsportal/WdGqmHpayyMjiEhcKoVE.png',
        'https://gw.alipayobjects.com/zos/rmsportal/zOsKZmFRdUtvpqCImOVY.png',
        'https://gw.alipayobjects.com/zos/rmsportal/dURIMkkrRFpPgTuzkwnB.png',
        'https://gw.alipayobjects.com/zos/rmsportal/sfjbOqnsXXJgNCjCzDBL.png',
        'https://gw.alipayobjects.com/zos/rmsportal/siCrBXXhmvTQGWPNLBow.png'
      ]

      const covers = [
        'https://gw.alipayobjects.com/zos/rmsportal/uMfMFlvUuceEyPpotzlq.png',
        'https://gw.alipayobjects.com/zos/rmsportal/iZBVOIhGJiAnhplqjvZW.png',
        'https://gw.alipayobjects.com/zos/rmsportal/iXjVmWVHbCJAyqvDxdtx.png',
        'https://gw.alipayobjects.com/zos/rmsportal/gLaIAoVWTtLbBWZNYEMg.png'
      ]

      const owner = [
        '付小小',
        '吴加好',
        '周星星',
        '林东东',
        '曲丽丽'
      ]

      const content = '段落示意：蚂蚁金服设计平台 ant.design，用最小的工作量，无缝接入蚂蚁金服生态，提供跨越设计与开发的体验解决方案。蚂蚁金服设计平台 ant.design，用最小的工作量，无缝接入蚂蚁金服生态，提供跨越设计与开发的体验解决方案。'
      const description = '在中台产品的研发过程中，会出现不同的设计规范和实现方式，但其中往往存在很多类似的页面和组件，这些类似的组件会被抽离成一套标准规范。'
      const href = 'https://ant.design'

      const data = []
      for (let i = this.start; i < this.count; i++) {
        const tmpKey = i + 1
        const num = parseInt(Math.random() * (4 + 1), 10)
        data.push({
          id: tmpKey,
          avatar: avatar[num],
          owner: owner[num],
          content: content,
          star: 4,
          percent: 27,
          like: 20,
          message: 20,
          description: description,
          href: href,
          title: titles[ i % 8 ],
          updatedAt: '2020-11-01 12:20:21',
          members: [
            {
              avatar: 'https://gw.alipayobjects.com/zos/rmsportal/ZiESqWwCXBRQoaPONSJe.png',
              name: '曲丽丽',
              id: 'member1'
            },
            {
              avatar: 'https://gw.alipayobjects.com/zos/rmsportal/tBOxZPlITHqwlGjsJWaF.png',
              name: '王昭君',
              id: 'member2'
            },
            {
              avatar: 'https://gw.alipayobjects.com/zos/rmsportal/sBxjgqiuHMGRkIjqlQCd.png',
              name: '董娜娜',
              id: 'member3'
            }
          ],
          activeUser: Math.ceil(Math.random() * 100000) + 100000,
          newUser: Math.ceil(Math.random() * 1000) + 1000,
          cover: parseInt(i / 4, 10) % 2 === 0 ? covers[i % 4] : covers[3 - (i % 4)]
        })
      }
      return data
    }
  }
}
</script>

<style scoped>
</style>
