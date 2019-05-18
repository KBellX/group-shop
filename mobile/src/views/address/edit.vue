<template>
  <div>
    <GoBack title="我的地址"/>
    <van-address-edit :address-info="addressInfo" :area-list="areaList" @save="save"/>
  </div>
</template>

<script>
import { getAddressDetail, addAddress, editAddress } from "@/api/address";
import GoBack from "@/components/GoBack";
import { Toast } from "vant";

export default {
  name: "address_list",
  components: {
    GoBack
  },
  data() {
    return {
      id: 0,
      areaList: {
        province_list: {
          110000: "北京市",
          120000: "天津市"
        },
        city_list: {
          110100: "北京市",
          110200: "县",
          120100: "天津市",
          120200: "县"
        },
        county_list: {
          110101: "东城区",
          110102: "西城区",
          110105: "朝阳区",
          110106: "丰台区",
          120101: "和平区",
          120102: "河东区",
          120103: "河西区",
          120104: "南开区",
          120105: "河北区"
        }
      },
      addressInfo: {}
    };
  },
  mounted() {
    if (this.$route.query.id) {
      this.id = this.$route.query.id;
      getAddressDetail(this.id).then(res => {
        let temp = {};
        temp.name = res.name;
        temp.tel = res.phone.toString();
        temp.areaCode = res.a_code.toString();
        temp.addressDetail = res.detail;
        this.addressInfo = temp;
      });
    }
  },
  methods: {
    save(content) {
      console.log(content);
      let data = {
        detail: content.addressDetail,
        code: content.areaCode,
        province: content.province,
        city: content.city,
        area: content.county,
        name: content.name,
        phone: content.tel
      };
      if (this.id == 0) {
        // 新增
        addAddress(data).then(() => {
          Toast("添加成功");
          this.$router.go(-1);
        });
      } else {
        // 编辑
        editAddress(this.id, data).then(() => {
          Toast("修改成功");
          this.$router.go(-1);
        });
      }
    }
  }
};
</script>