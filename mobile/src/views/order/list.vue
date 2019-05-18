<template>
  <div>
    <GoBack title="订单列表" :back_url="backUrl"/>
    <van-tabs v-model="tab" @change="changeTab">
      <van-tab title="全部">
        <OrderList :orderList="orderList"/>
      </van-tab>
      <van-tab title="待付款">
        <OrderList :orderList="orderList"/>
      </van-tab>
      <van-tab title="拼团中">
        <OrderList :orderList="orderList"/>
      </van-tab>
      <van-tab title="待发货">
        <OrderList :orderList="orderList"/>
      </van-tab>
      <van-tab title="拼团失败">
        <OrderList :orderList="orderList"/>
      </van-tab>
      <van-tab title="待签收">
        <OrderList :orderList="orderList"/>
      </van-tab>
      <van-tab title="已完成">
        <OrderList :orderList="orderList"/>
      </van-tab>
    </van-tabs>
  </div>
</template>

<script>
import GoBack from "@/components/GoBack";
import { getOrderList } from "@/api/order";
import OrderList from "@/components/OrderList";

export default {
  name: "order_detail",
  data() {
    return {
      backUrl: "/user",
      tab: 0,
      status: -1,
      orderList: []
    };
  },
  components: {
    GoBack,
    OrderList
  },
  methods: {
    goDetail(id) {
      this.$router.push({ path: "/order_detail", query: { id: id } });
    },
    changeTab(index) {
      this.status = index - 1;
      this.getList();
    },
    getList() {
      getOrderList(this.status).then(res => {
        console.log(res);
        this.orderList = res;
      });
    }
  },
  mounted() {
    this.status = this.$route.query.status;
    this.tab = parseInt(this.status) + 1;
    this.getList();
  }
};
</script>

