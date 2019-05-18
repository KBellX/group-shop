<template>
  <div>
    <GoBack title="我的地址"/>
    <van-address-list :list="list" @add="add" @edit="edit"/>
  </div>
</template>

<script>
import GoBack from "@/components/GoBack";
// import { getAddressList, deleteAddress } from "@/api/address";
import { getAddressList } from "@/api/address";

export default {
  name: "address_list",
  components: {
    GoBack
  },
  data() {
    return {
      total: 0,
      list: [
        {
          id: "1",
          name: "张三",
          tel: "13000000000",
          address: "浙江省杭州市西湖区文三路 138 号东方通信大厦 7 楼 501 室"
        },
        {
          id: "2",
          name: "李四",
          tel: "1310000000",
          address: "浙江省杭州市拱墅区莫干山路 50 号"
        }
      ]
    };
  },
  mounted() {
    getAddressList().then(res => {
      this.total = res.total;
      let list = [];
      res.list.forEach(item => {
        let temp = {};
        temp.id = item.id;
        temp.name = item.name;
        temp.tel = item.phone;
        temp.address = item.province + item.city + item.area + item.detail;
        list.push(temp);
      });
      this.list = list;
    });
  },
  methods: {
    add() {
      this.$router.push({ path: "/address_edit" });
    },
    edit(row) {
      console.log(row.id);
      this.$router.push({ path: "/address_edit", query: { id: row.id } });
    }
  }
};
</script>

