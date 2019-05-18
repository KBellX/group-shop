<template>
  <div>
    <GoBack title="订单详情" :back_url="backUrl"/>
    <h1>{{order.status | orderStatusFilter}}</h1>
    <OrderAddress :address="address"/>
    <!-- 订单商品组件 -->
    <OrderGoods :orderGoodsList="order.order_goods"/>
    <!-- 订单号，订单创建时间 -->
    <van-cell-group>
      <van-cell title="订单号" :value="order.order_no" size="large"/>
      <van-cell title="订单创建时间" :value="order.create_at" size="large"/>
    </van-cell-group>
    <!-- 操作按钮 -->
    <div class="button">
      <van-button v-if="order.status == 0" plain type="danger" @click="goPay()">立即付款</van-button>
      <van-button v-if="order.status == 4" plain type="danger" @click="sign()">确认收货</van-button>
    </div>
  </div>
</template>

<script>
import GoBack from "@/components/GoBack";
import { getOrderDetail, signOrder } from "@/api/order";
import { orderStatusFilter } from "@/utils/filter";
import OrderAddress from "@/components/OrderAddress";
import OrderGoods from "@/components/OrderGoods";
import { Toast } from "vant";

export default {
  name: "order_detail",
  components: {
    GoBack,
    OrderAddress,
    OrderGoods
  },
  data() {
    return {
      id: 0,
      order: {},
      backUrl: "/order_list",
      address: {
        address: "",
        name: "",
        tel: ""
      }
    };
  },
  filters: {
    orderStatusFilter
  },
  methods: {
    goPay() {
      this.$router.push({
        name: "pay",
        query: {
          orderId: this.order.id,
          orderNo: this.order.order_no,
          money: this.order.real_price
        }
      });
    },
    sign() {
      signOrder(this.id).then(() => {
        Toast("签收成功");
        this.$router.go(0);
      });
    }
  },
  created() {
    this.id = this.$route.query.id;
    getOrderDetail(this.id).then(res => {
      this.address.address = res.address;
      this.address.name = res.consignee;
      this.address.tel = res.phone;
      console.log(res);
      this.order = res;
    });
  }
};
</script>

