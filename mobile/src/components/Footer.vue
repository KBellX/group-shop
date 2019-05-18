<template>
  <van-tabbar active-color="#FF3030" v-model="active" @change="changeTab">
    <van-tabbar-item icon="home-o">首页</van-tabbar-item>
    <van-tabbar-item icon="apps-o">分类</van-tabbar-item>
    <van-tabbar-item icon="friends-o">我的</van-tabbar-item>
  </van-tabbar>
</template>

<script>
import { invertKeyValues } from "@/utils/common";

export default {
  name: "Footer",
  data() {
    return {
      active: 0,
      tabMap: {
        0: "home",
        1: "cate",
        2: "user"
      }
    };
  },
  mounted() {
    this.initTab();
  },
  methods: {
    changeTab(active) {
      this.$router.push({ name: this.tabMap[active] });
    },
    initTab() {
      const rTapMap = invertKeyValues(this.tabMap);
      this.active = parseInt(rTapMap[this.$route.name]);
    }
  }
};
</script>