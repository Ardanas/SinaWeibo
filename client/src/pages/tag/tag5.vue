<template>
  <div class="el-container">
    <el-row style="width: 100%">
      <el-col :span="24">
        <h1 class="Font Mar_b_10">正在热映</h1>
      </el-col>
      <el-col :span="24" class="items-container" v-for="(item, index) in resList" :key="index">
        <el-row>
          <el-col :span="7">
            <img :src="$utils.fixPic403(item.images.medium)" alt="图片加载失败" width="100%">
          </el-col>
          <el-col :span="12" style="border-right: 1px solid #e5e5e5;">
            <div class style="margin: 0 0 10px 10px;">
              <ul>
                <li class="w_f14">
                  <h1 class="Font Mar_b_10 M_detail_title">
                    <span>{{item.title}}</span>
                    <span style="color: #888;">({{item.year}})</span>
                  </h1>
                </li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">
                  <span>导演：{{item.directors[0].name}}</span>
                </li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">演员：{{item.performer}}</li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">类型：{{item.genres.join("/")}}</li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">评分：{{item.rating.average}}</li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">收藏：{{item.collect_count}}</li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">上映时间：{{item.year}}</li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">演员列表：</li>
                <li class="S_txt1 M_type w_f17 Mar_t_5">
                  <el-row>
                    <el-col
                      :span="6"
                      class="M_list_box"
                      v-for="(casts, casts_index) in item.casts"
                      :key="casts_index"
                    >
                      <img
                        :src="$utils.fixPic403(casts.avatars.medium)"
                        alt="图片加载失败"
                        class="M_detail_img"
                      >
                      <p>{{casts.name}}</p>
                    </el-col>
                  </el-row>
                </li>
              </ul>
            </div>
          </el-col>
          <el-col :span="5">
            <div class="S_txt1 M_type w_f17 M_detail_score_box">
              <span class="Mar_t_5 M_detail_link">豆瓣评分：</span>
              <p class="M_detail_score">{{item.rating.average}}</p>
              <p class="M_detail_link">
                <a :href="item.alt" target="_blank">点击查阅更多电影信息....</a>
              </p>
            </div>
          </el-col>
        </el-row>
      </el-col>
      <el-col :span="24">
        <v-loading :isLoading="isLoading"></v-loading>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import VLoading from "../../components/loading";
export default {
  data() {
    return {
      resList: {},
      isLoading: true
    }
  },
  components: {
    VLoading
  },
  mounted() {
    this.$api.getTagFiveList().then(
      res => {
        console.log(res);
        this.isLoading = false;
        if (res.count !== 0) {
          let items = res.subjects;
          this.resList = items;
          for (let item of items) {
            let performerList = [];
            for (let performer of item.casts) {
              performerList.push(performer.name);
            }
            item.performer = performerList.join("/");
          }
        }
      },
      err => {
        console.log(err);
      }
    );
  }
};
</script>

