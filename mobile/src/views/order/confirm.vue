<template>
  <div>
    <GoBack title="确认订单"/>
    <OrderAddress :address="address"/>
    <div class="goods">
      <van-row>
        <van-col span="6">
          <img class="goods-img" :src="goodsInfo.thum">
        </van-col>
        <van-col span="18">
          <van-row>
            <van-col style="text-align:left" span="24">{{goodsInfo.name}}</van-col>
            <van-col span="24">
              <van-row type="flex" justify="space-between">
                <van-col>{{goodsInfo.sell_price}}</van-col>
                <van-col>✖️{{goodsInfo.num}}</van-col>
              </van-row>
            </van-col>
          </van-row>
        </van-col>
      </van-row>
    </div>
    <div class="remark">
      <van-cell-group>
        <van-field
          v-model="remark"
          label="留言"
          type="textarea"
          placeholder="请输入留言"
          rows="1"
          autosize
        />
      </van-cell-group>
    </div>
    <van-submit-bar :price="price" button-text="提交订单" @submit="submit"/>
  </div>
</template>

<script>
import GoBack from "@/components/GoBack";
import OrderAddress from "@/components/OrderAddress";
import { getDefaultAddress } from "@/api/address";
import { addOrder } from "@/api/order";
import { getStorage, removeStorage } from "@/utils/sessionStorage";
export default {
  name: "order_confirm",
  components: {
    GoBack,
    OrderAddress
  },
  data() {
    return {
      pId: 0,
      goodsInfo: {},
      remark: "",
      address: {
        id: 0,
        address: "",
        name: "",
        tel: ""
      }
    };
  },
  mounted() {
    this.pId = getStorage("p_id");
    this.goodsInfo = JSON.parse(getStorage("goods_info"));

    // 获取默认地址
    getDefaultAddress().then(res => {
      let temp = {};
      temp.id = res.id;
      temp.name = res.name;
      temp.tel = res.phone;
      temp.address = res.province + res.city + res.area + res.detail;
      this.address = temp;
    });
  },
  methods: {
    submit() {
      let data = {
        p_id: this.pId,
        goods_list: [],
        address_id: this.address.id,
        remark: this.remark
      };
      let goods = {
        id: this.goodsInfo.id,
        num: this.goodsInfo.num
      };
      data.goods_list.push(goods);
      addOrder(data).then(res => {
        console.log(res);
        // 跳支付页面
        removeStorage("goods_info");
        removeStorage("p_id");
        this.$router.replace({
          name: "pay",
          query: {
            orderId: res.id,
            orderNo: res.order_no,
            money: res.real_price
          }
        });
        // this.$router.replace({ name: "order_detail", query: { id: res.id } });
      });
    }
  },
  computed: {
    price() {
      return this.goodsInfo.sell_price * this.goodsInfo.num * 100;
    }
  }
};
</script>

<style>
.goods-img {
  width: 100%;
  height: 80px;
}
</style>
