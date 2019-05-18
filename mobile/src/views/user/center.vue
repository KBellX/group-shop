<template>
  <div>
    <div style="margin:30px">
      <van-row type="flex" justify="space-between">
        <van-col>{{user.nickname}}</van-col>
        <van-col>
          <van-icon @click="goSetting" name="setting-o"/>
        </van-col>
      </van-row>
    </div>
    <div style="margin:30px">
      <van-row type="flex" justify="space-between">
        <van-col>我的订单</van-col>
        <van-col>
          <div @click="goOrderList(-1)">全部订单</div>
        </van-col>
      </van-row>
      <van-row type="flex" justify="space-around">
        <van-col span="6">
          <div @click="goOrderList(0)">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="column"/>
              </van-col>
              <van-col span="24">待付款</van-col>
            </van-row>
          </div>
        </van-col>
        <van-col span="6">
          <div @click="goOrderList(1)">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="column"/>
              </van-col>
              <van-col span="24">拼团中</van-col>
            </van-row>
          </div>
        </van-col>
        <van-col span="6">
          <div @click="goOrderList(2)">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="column"/>
              </van-col>
              <van-col span="24">待发货</van-col>
            </van-row>
          </div>
        </van-col>
        <van-col span="6">
          <div @click="goOrderList(3)">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="column"/>
              </van-col>
              <van-col span="24">拼团失败</van-col>
            </van-row>
          </div>
        </van-col>
        <van-col span="6">
          <div @click="goOrderList(4)">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="column"/>
              </van-col>
              <van-col span="24">待签收</van-col>
            </van-row>
          </div>
        </van-col>
        <van-col span="6">
          <div @click="goOrderList(5)">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="column"/>
              </van-col>
              <van-col span="24">已完成</van-col>
            </van-row>
          </div>
        </van-col>
      </van-row>
    </div>
    <div style="margin:30px">
      <van-row type="flex" justify="space-between">
        <van-col span="6">我的服务</van-col>
      </van-row>
      <van-row type="flex">
        <van-col span="6">
          <div @click="goAddress()">
            <van-row>
              <van-col span="24">
                <van-icon size="2em" name="location-o
"/>
              </van-col>
              <van-col span="24">我的地址</van-col>
            </van-row>
          </div>
        </van-col>
      </van-row>
    </div>

    <Loading/>
    <Footer/>
  </div>
</template>
<script>
import { getUserInfo } from "@/api/user";
import Loading from "@/components/Loading";
import Footer from "@/components/Footer";

export default {
  name: "login",
  components: {
    Loading,
    Footer
  },
  data() {
    return {
      user: {
        nickname: ""
      }
    };
  },
  methods: {
    goSetting() {
      this.$router.push("/setting");
    },
    goAddress() {
      this.$router.push({ path: "/address" });
    },
    goOrderList(status) {
      this.$router.push({ path: "/order_list", query: { status: status } });
    }
  },
  mounted() {
    getUserInfo().then(res => {
      this.user = res;
    });
  }
};
</script>

