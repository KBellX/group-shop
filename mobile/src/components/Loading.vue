<template>
  <van-loading class="loading" size="100" type="spinner" v-show="status"/>
</template>

<script>
export default {
  name: "Loading",
  computed: {
    status() {
      return this.$store.state.loading.status;
    }
  }
};
</script>

<style>
.loading {
  position: fixed;
  left: 44%;
  top: 50%;
}
</style>