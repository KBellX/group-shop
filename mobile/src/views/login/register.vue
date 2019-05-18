<template>
  <div>
    <h1>Register</h1>
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
        ref="password"
      />
    </van-cell-group>
    <van-cell-group>
      <van-field
        type="password"
        v-model="passwordConfirm"
        placeholder="确认密码"
        clearable
        name="passwordConfirm"
        v-validate="'required|confirmed:password'"
        :error-message="errors.first('passwordConfirm')"
      />
    </van-cell-group>

    <van-button class="btn" size="large" square type="warning" @click="goRegister">注册</van-button>
    <van-button class="btn" size="large" square @click="goLogin">已有账号，去登录</van-button>
  </div>
</template>

<script>
import { register } from "@/api/user";
import { Toast } from "vant";

export default {
  name: "register",
  data() {
    return {
      username: "",
      password: "",
      passwordConfirm: ""
    };
  },
  methods: {
    goLogin() {
      this.$router.push({ path: "/login" });
    },
    goRegister() {
      this.$validator.validate().then(valid => {
        if (valid) {
          register(this.username, this.password).then(() => {
            Toast("注册成功");
            this.$router.push("/login");
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