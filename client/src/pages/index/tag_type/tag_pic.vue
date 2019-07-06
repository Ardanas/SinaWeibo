<template>
  <el-container>
    <el-row class="w_100">
      <el-col :span="24" v-for="(item, index) in resList" :key="index">
        <v-p-1 :propsList="item" v-if="item.picture.length == 1"></v-p-1>
        <v-p-4
          :propsList="item"
          v-else-if="item.picture.length == 4 || item.picture.length == 7 || item.picture.length == 8"
        ></v-p-4>
        <v-p-9 :propsList="item" v-else></v-p-9>
      </el-col>
    </el-row>
  </el-container>
</template>

<script>
export default {
  data() {
    return {
      resList: []
    };
  },
  methods: {
    getUserTypeMsg() {
      this.$api.getUserTypeMsg({type: '图片'}).then(
        res => {
          console.log(res);
          if(res.data.status == 200){
            this.resList = res.data.datas
          }
        },
        err => {
          console.log(err);
        }
      );
    }
  },
  created() {
    this.getUserTypeMsg();
  }
};
</script>



