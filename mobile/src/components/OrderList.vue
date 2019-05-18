<template>
  <div>
    <div v-for="(order, oIndex) in orderList" :key="oIndex">
      <div @click="goDetail(order.id)">
        <van-row type="flex" justify="space-between">
          <van-col>{{order.create_at}}</van-col>
          <van-col>{{order.status | orderStatusFilter}}</van-col>
        </van-row>
        <OrderGoods :orderGoodsList="order.order_goods"/>
      </div>
    </div>
  </div>
</template>

<script>
import OrderGoods from "@/components/OrderGoods";
import { orderStatusFilter } from "@/utils/filter";

export default {
  name: "OrderList",
  props: ["orderList"],
  components: {
    OrderGoods
  },
  filters: {
    orderStatusFilter
  },
  methods: {
    goDetail(id) {
      this.$router.push({ path: "/order_detail", query: { id: id } });
    }
  }
};
</script>

