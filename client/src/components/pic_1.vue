<template>
  <!--1张图片-->
  <div class="weiboBox">
    <div class="userInfoBox clearfix">
      <div class="userInfo_sm">
        <div class="userImg fl" :title="propsList.u_name">
          <a href="#">
            <img :src="$HOST + propsList.u_cover.substring(3)" alt>
          </a>
        </div>
        <div class="Info fl" :title="propsList.u_name">
          <h3 class="userTit">
            <a href="#">
              {{propsList.u_name}}
              <img src="../assets/img/vipIcon2.png" alt>
            </a>
            <img src="../assets/img/lv_big.png" alt>
          </h3>
          <p class="time">
            <em>{{propsList.created_at}}</em>前
            <em>来自</em>
            <em>
              <a href="#">微博weibo.com</a>
            </em>
          </p>
        </div>
      </div>
      <div class="weiboText">
        <p class="w_f14 wb_text" v-html="$emoji(propsList.content)"></p>
        <div>
          <el-row>
            <el-col :span="24" v-for="(o, index) in propsList.picture" :key="index">
              <div :class="[isClickPic?'':'pic_1']" @click="togglePic">
                <el-image
                  :src="$HOST + o.substring(2)"
                  fit="fit"
                  class="fit_img large_mirror"
                  :class="[isClickPic?'small_mirror':'large_mirror']"
                >
                  
                  <div slot="error" class="image-slot">
                    <i class="el-icon-picture-outline"></i>
                  </div>
                </el-image>
              </div>
            </el-col>
          </el-row>
        </div>
      </div>
    </div>
    <v-bottom-bar></v-bottom-bar>
  </div>
</template>

<script>
export default {
  props: {
    propsList: {
      default: {}
    }
  },
  data() {
    return {
      isClickPic: false
    };
  },
  methods: {
    togglePic() {
      this.isClickPic = !this.isClickPic;
    }
  }
};
</script>

