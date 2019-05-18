<template>
  <div>
    <div v-for="(item, index) in orderGoodsList" :key="index">
      <van-card
        style="text-align:left"
        :num="item.num"
        :price="item.real_price"
        :origin-price="item.sell_price"
        :title="item.goods_name"
        :thumb="item.thum"
      />
    </div>
  </div>
</template>

<script>
export default {
  name: "OrderGoods",
  props: ["orderGoodsList"]
};
</script>

