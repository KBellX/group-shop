<template>
  <div class="address">
    <van-row>
      <van-col span="24">{{address.address}}</van-col>
      <van-col span="24">
        <van-row type="flex" justify="space-around">
          <van-col span="6">{{address.name}}</van-col>
          <van-col span="6">{{address.tel}}</van-col>
        </van-row>
      </van-col>
    </van-row>
  </div>
</template>

<script>
export default {
  name: "OrderAddress",
  props: ["address"]
};
</script>
