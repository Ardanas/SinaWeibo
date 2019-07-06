<template>
  <el-container>
    <el-row class="w_100">
      <el-col :span="24" v-for="(item, index) in resList" :key="index">
        <div v-if="item.at_type=='文章'">
          <v-word :propsList="item"></v-word>
        </div>
        <div v-else-if="item.at_type=='图片'">
          <v-p-1 :propsList="item" v-if="item.picture.length == 1"></v-p-1>
          <v-p-4
            :propsList="item"
            v-else-if="item.picture.length == 4 || item.picture.length == 7 || item.picture.length == 8"
          ></v-p-4>
          <v-p-9 :propsList="item" v-else></v-p-9>
        </div>
        <div v-else>
          <v-video :propsList="item"></v-video>
        </div>
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
    getUserIndexMsg() {
      this.$api.getUserIndexMsg().then(
        res => {
          console.log(res);
          if (res.data.status == 200) {
            let items = res.data.datas;
            this.resList = items.mainMessage;
          }
        },
        err => {
          console.log(err);
        }
      );
    }
  },
  created() {
    this.getUserIndexMsg();
  }
};
</script>


