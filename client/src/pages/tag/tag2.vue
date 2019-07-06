<template>
  <el-container>
    <el-row style="width: 100%;">
      <el-col :span="24" style="margin-bottom: 20px;">
        <span class="Font Mar_b_10 W_f20" style="font-weight: bold;">{{city[1]?city[1]:"本地"}}新闻：</span>
        <span class="el-icon-location W_f20"></span>    
        <el-cascader
          expand-trigger="hover"
          :options="options"
          v-model="city"
          @change="handleChange"
          size="small"
        ></el-cascader>
      </el-col>
      <el-col :span="24">
        <v-data-list :resList="resList" :isLoading="isLoading" :tid="id"></v-data-list>
      </el-col>
    </el-row>
  </el-container>
</template>


<script>
import VDataList from "../../components/datalist";
export default {
  props: ["id"],
  data() {
    return {
      resList: {},
      isLoading: true,
      city: [],
      options: [
          {
            value: "GD",
            label: "广东省",
            children: [
              {
                value: "广州市",
                label: "广州市"
              },
              {
                value: "深圳市",
                label: "深圳市"
              },
              {
                value: "珠海市",
                label: "珠海市"
              },
              {
                value: "佛山市",
                label: "佛山市"
              },
              {
                value: "惠州市",
                label: "惠州市"
              },
              {
                value: "中山市",
                label: "中山市"
              },
              {
                value: "梅州市",
                label: "梅州市"
              },
              {
                value: "潮州市",
                label: "潮州市"
              },
              {
                value: "揭阳市",
                label: "揭阳市"
              },
              {
                value: "东莞市",
                label: "东莞市"
              },
              {
                value: "湛江市",
                label: "湛江市"
              }
            ]
          }
        ],
    };
  },
  components: {
    VDataList
  },
  methods: {
    handleChange(value) {
      console.log(value[1]);
      this.getDataList(value[1]);
    },
    getDataList(city) {
      this.$api.getTagTwoList(city, 0).then(
        res => {
          console.log(res);
          if (res.code == 1) {
            this.resList = res.data;
            this.isLoading = false;
          }
        },
        err => {
          console.log(err);
        }
      );
    }
  },
  mounted() {
    this.getDataList("广州市");
  }
};
</script>




