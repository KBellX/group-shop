<template>
  <div id="app">
    <!-- <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
      <router-link to="/login">Login</router-link>
    </div>-->
    <!-- <van-button type="primary" @click="close">关闭</van-button>
    <van-button type="primary" @click="open">开启</van-button>
    <van-button type="primary" @click="jump">个人中心</van-button>-->
    <router-view v-if="isRouterAlive"/>
  </div>
</template>

<script>
export default {
  name: "app",
  computed: {
    isRouterAlive() {
      return this.$store.state.router.status;
    }
  },
  created() {
    //在页面加载时读取sessionStorage里的状态信息
    if (sessionStorage.getItem("store")) {
      this.$store.replaceState(
        Object.assign(
          {},
          this.$store.state,
          JSON.parse(sessionStorage.getItem("store"))
        )
      );
    }
    //在页面刷新时将vuex里的信息保存到sessionStorage里
    window.addEventListener("beforeunload", () => {
      sessionStorage.setItem("store", JSON.stringify(this.$store.state));
    });
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  /* margin-top: 60px; */
}
</style>
