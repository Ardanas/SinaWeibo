<template>
  <el-container>
    <el-row :gutter="20" style="width: 100%;">
      <el-col :span="24">
        <h1 class="Font Mar_b_10">Top5 新鲜事</h1>
      </el-col>
      <el-col :span="8" class="Mar_b_10" v-for="(item, index) in resList.top_stories" :key="index">
        <div>
          <img :src="item.image" alt="图片加载失败" width="100%">
        </div>
        <div>
          <h3 class="Font">{{item.title}}</h3>
        </div>
      </el-col>
      
      <el-col :span="24">
        <v-loading :isLoading="isLoading"></v-loading>
      </el-col>
    </el-row>
  </el-container>
</template>

<script>
import VLoading from "../../components/loading";
export default {
  props: ["id"],
  data() {
    return {
      resList: {},
      isLoading: true,
    };
  },
  components: {
    VLoading
  },
  methods: {
    getMsgList() {
      this.$api.getNovelty().then(
        res => {
          console.log(res);
          if (res.code === 1) {
            let items = res.data;
            this.isLoading = false;
            this.resList = items;
          }
        },
        err => {}
      );
    }
  },
  mounted() {
    this.getMsgList();
  }
};
</script>
