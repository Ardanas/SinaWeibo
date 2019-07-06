<template>
  <div class="content-video">
    <div
      class="content-videolist-detail"
      v-for="(item,index) in resList"
      :key="index"
      @click="showDetail(item)"
    >
      <a href="#" class="v_link">
        <img :src="item.cover">
      </a>
      <div class="content-viedo-name">
        <h3 class="listInfo" :title="item.title">{{item.title}}</h3>
      </div>
      <div class="content-viedo-author">
        <img :src="item.topicImg" :alt="item.topicDesc" width="20" height="20">
        <span>{{item.topicDesc}}</span>
      </div>
      <div class="content-viedo-author">{{item.votecount}}次观看</div>
    </div>
    <v-loading :isLoading="isLoading"></v-loading>
    <el-dialog :title="detailDatas.title" :visible.sync="dialogVisible" @close="closeDetail">
      <el-col>
        <video :src="detailDatas.mp4_url" controls autoplay :poster="detailDatas.cover" id="video"></video>
      </el-col>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="closeDetail">关 闭</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import VLoading from "../../components/loading";
export default {
  props: ["id"],
  data() {
    return {
      resList: {},
      isLoading: true,
      dialogVisible: false,
      detailDatas: {}
    };
  },
  components: {
    VLoading
  },
  methods: {
    getDataList() {
      this.$api.getTagThreeList().then(
        res => {
          console.log(res);
          this.isLoading = false;
          this.resList = res.data.videoList;
        },
        err => {
          console.log(err);
        }
      );
    },
    showDetail(item) {
      this.dialogVisible = true;
      this.detailDatas = item;
    },
    closeDetail() {
      console.log("close");
      let video = document.getElementById("video");
      this.dialogVisible = false;
      video.pause();
    }
  },
  mounted() {
    this.getDataList();
  }
};
</script>
