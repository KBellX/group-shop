<template>
  <div>
    <GoBack title="支付" :back_url="backUrl"/>
    <van-cell-group>
      <van-cell title="订单号" :value="this.orderNo"/>
      <van-cell title="金额" :value="`￥${this.money}`"/>
    </van-cell-group>

    <van-button type="danger" size="large" @click="pay">确认支付</van-button>

    <van-popup v-model="show">
      <van-cell-group>
        <van-field v-model="password" type="password" placeholder="输入支付密码"/>
        <van-button type="info" @click="commit">确认</van-button>
      </van-cell-group>
    </van-popup>
  </div>
</template>

<script>
import GoBack from "@/components/GoBack";
import { payByMoney } from "@/api/pay";
import { Toast } from "vant";

export default {
  name: "pay",
  components: {
    GoBack
  },
  data() {
    return {
      show: false,
      orderId: 0,
      orderNo: "",
      money: 0,
      backUrl: "/order_detail?id=",
      password: ""
    };
  },
  mounted() {
    let params = this.$route.query;
    this.orderId = params.orderId;
    this.orderNo = params.orderNo;
    this.money = params.money;
    this.backUrl = this.backUrl + this.orderId;
  },
  methods: {
    pay() {
      this.show = true;
    },
    commit() {
      if (!this.password) {
        return;
      }
      payByMoney(this.orderId, this.password).then(() => {
        Toast("支付成功");
        this.$router.replace({
          path: "/order_detail",
          query: { id: this.orderId }
        });
      });
    }
  }
};
</script>

