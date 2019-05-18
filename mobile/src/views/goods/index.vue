<template>
  <div>
    <GoBack title="商品详情"/>
    <div>
      <van-swipe :autoplay="3000" indicator-color="white">
        <van-swipe-item v-for="(item,index) in goods.imgs" :key="index">
          <img class="swipe-img" :src="item">
        </van-swipe-item>
      </van-swipe>
      <div class="content">
        <van-row type="flex" justify="space-between">
          <van-col class="sell-price">
            <van-tag plain round type="danger">{{goods.people_num}}人团</van-tag>
            ￥{{goods.sell_price}}
            <span style="font-size:10px">(拼团价)</span>
          </van-col>
          <van-col class="market-price">￥{{goods.market_price}}</van-col>
        </van-row>
        <van-cell class="name" :value="goods.name"/>
        <van-row type="flex" justify="space-between">
          <van-col>快递：{{goods.express}}</van-col>
          <van-col>库存：{{goods.stock}}</van-col>
          <van-col>销量：{{goods.sell_num}}</van-col>
        </van-row>
      </div>
      <div class="teams" v-if="teams.length > 0">
        <h3 style="text-align:center">拼团队伍</h3>
        <div v-for="(team, index) in teams" :key="index">
          <van-row type="flex" justify="space-around" style="margin:20px 0">
            <!-- <van-col>
              <img :src="team.user.avatar">
            </van-col>-->
            <van-col>团长：{{team.user.nickname}}</van-col>
            <van-col>还剩{{team.validity}}小时</van-col>
            <van-col>
              <van-button type="warning" @click="buy(team.order_id)">拼团</van-button>
            </van-col>
          </van-row>
        </div>
      </div>
      <van-tabs v-model="tab">
        <van-tab title="商品介绍">
          <div class="detail">
            <div v-for="(item, index) in goods.detail" :key="index">
              <img class="detail-img" :src="item">
            </div>
          </div>
        </van-tab>
        <van-tab title="属性参数">无</van-tab>
      </van-tabs>
    </div>

    <van-goods-action>
      <van-goods-action-big-btn primary text="开团" @click="buy(0)"/>
    </van-goods-action>
  </div>
</template>
o
<script>
import { getGoodsDetail, getGroupingList } from "@/api/goods";
import { setStorage } from "@/utils/sessionStorage";
import GoBack from "@/components/GoBack";

export default {
  name: "detail",
  components: {
    GoBack
  },
  data() {
    return {
      id: 0,
      goods: {},
      tab: 0,
      teams: []
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1);
    },
    buy(pId) {
      let goodsInfo = {
        id: this.id,
        num: 1,
        name: this.goods.name,
        thum: this.goods.thum,
        sell_price: this.goods.sell_price,
        market_price: this.goods.market_price
      };
      setStorage("goods_info", JSON.stringify(goodsInfo));
      setStorage("p_id", pId);
      this.$router.push({ name: "order_confirm" });
    }
  },
  mounted() {
    this.id = this.$route.query.id;
    getGoodsDetail(this.id).then(res => {
      this.goods = res;
    });
    getGroupingList(this.id).then(res => {
      this.teams = res;
      console.log(this.teams);
    });
  }
};
</script>


<style>
.swipe-img {
  width: auto;
  height: 414px;
}
.content {
  width: 94%;
  margin: 0 auto;
}
.sell-price {
  color: red;
  font-size: 24px;
  font-weight: bold;
}
.market-price {
  text-decoration: line-through;
}
.name {
  font-size: 14px;
  color: #051b28;
  line-height: 20px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  max-height: 63px;
  -webkit-box-orient: vertical;
  -webkit-box-pack: center;
  overflow: hidden;
  word-break: break-all;
}
.detail-img {
  display: block;
  margin: 0 auto;
  vertical-align: top;
  max-width: 100%;
}
</style>