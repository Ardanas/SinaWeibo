<template>
  <el-container>
    <el-row class="w_100">
      <el-col :span="24" v-for="(item, index) in resList" :key="index">
        <v-video :propsList="item"></v-video>
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
      this.$api.getUserTypeMsg({ type: "视频" }).then(
        res => {
          console.log(res);
          if (res.data.status == 200) {
            this.resList = res.data.datas;
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