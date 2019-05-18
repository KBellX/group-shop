<template>
  <div>
    <GoBack title="设置"/>
    <van-button size="large" type="warning" @click="doLogout">退出</van-button>
  </div>
</template>

<script>
import GoBack from "@/components/GoBack";
import { logout } from "@/api/user";
import { removeToken, removeRefreshToken } from "@/utils/auth";

export default {
  name: "setting",
  components: {
    GoBack
  },
  methods: {
    doLogout() {
      logout().then(() => {
        removeToken();
        removeRefreshToken();
        this.$router.replace("/home");
      });
    }
  }
};
</script>

