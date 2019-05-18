<template>
  <van-nav-bar :title="title" left-text="返回" left-arrow @click-left="goBack"/>
</template>

<script>
export default {
  name: "GoBack",
  props: ["title", "back_url"],
  methods: {
    goBack() {
      if (this.back_url) {
        this.$router.replace(this.back_url);
      } else {
        this.$router.go(-1);
      }
    }
  }
};
</script>

