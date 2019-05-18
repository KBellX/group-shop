<template>
  <div>
    <van-list v-model="loading" :finished="finished" finished-text="没有更多了" @load="onLoad">
      <van-row>
        <van-col span="12" v-for="item in list" :key="item.id">
          <div class="box" @click="goDetail(item.id)">
            <img class="thum" :src="item.thum">
            <div class="name">{{item.name}}</div>
            <van-row type="flex" justify="space-between" class="price">
              <van-col class="sell-price">￥{{item.sell_price}}</van-col>
              <van-col class="market-price">￥{{item.market_price}}</van-col>
            </van-row>
          </div>
        </van-col>
      </van-row>
    </van-list>
    <Footer/>
  </div>
</template>

<script>
import Footer from "@/components/Footer";
import { getGoodsListByCate } from "@/api/goods";

export default {
  name: "cate",
  components: {
    Footer
  },
  data() {
    return {
      list: [],
      tatal: 0,
      loading: false,
      finished: false,
      cateId: 0,
      pageIdx: 1,
      pageSize: 20
    };
  },
  mounted() {
    this.cateId = this.$route.query.cate_id;
    this.getList();
  },
  methods: {
    goDetail(id) {
      this.$router.push({ path: "/detail", query: { id: id } });
    },
    getList() {
      getGoodsListByCate(this.pageIdx, this.pageSize, this.cateId).then(res => {
        this.total = res.total;
        this.list = this.list.concat(res.list);
        // console.log(this.list);
        this.loading = false;
        if (this.list.length >= this.total) {
          this.finished = true;
        }
      });
    },
    onLoad() {
      // 滑动到底部：自动将loading设为true
      this.pageIdx++;
      this.getList();
    }
  }
};
</script>

<style>
.box {
  margin: 4px;
}
.thum {
  width: auto;
  height: 200px;
}
.name {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  height: 19px;
  display: block;
}
.price {
  width: 94%;
  margin: 0 auto;
}
.sell-price {
  color: red;
}
.market-price {
  text-decoration: line-through;
}
</style>