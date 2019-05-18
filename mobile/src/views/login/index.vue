<template>
  <div>
    <h1>Login</h1>
    <van-cell-group>
      <van-field
        v-model="username"
        placeholder="账号"
        clearable
        name="username"
        v-validate="'required'"
        :error-message="errors.first('username')"
      />
    </van-cell-group>
    <van-cell-group>
      <van-field
        type="password"
        v-model="password"
        placeholder="密码"
        clearable
        name="password"
        v-validate="'required'"
        :error-message="errors.first('password')"
      />
    </van-cell-group>
    <van-button class="btn" size="large" square type="warning" @click="goLogin">登录</van-button>
    <van-button class="btn" size="large" square @click="goRegister">注册</van-button>
  </div>
</template>

<script>
import { loginByUsername } from "@/api/user";
import { setToken, setRefreshToken } from "@/utils/auth.js";

export default {
  name: "login",
  data() {
    return {
      username: "",
      password: ""
    };
  },
  mounted() {
    console.log(this.$route);
  },
  methods: {
    goRegister() {
      this.$router.push({ path: "/register" });
    },
    goLogin() {
      this.$validator.validate().then(valid => {
        if (valid) {
          loginByUsername(this.username, this.password).then(res => {
            setToken(res.token);
            setRefreshToken(res.refresh_token);

            if (this.$route.query.redirect) {
              // 如果有来源页，跳回来源页
              this.$router.push({ path: this.$route.query.redirect });
            } else {
              this.$router.push({ path: "/user" });
            }
          });
        }
      });
    }
  }
};
</script>

<style>
.btn {
  width: 85%;
  margin: 1.8rem auto;
}
</style>