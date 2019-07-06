<template>
  <div class="weiboList">
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
          <p class="w_f14 wb_text" v-html="propsList.content"></p>
          <div class>
            <video
              :src="$HOST + propsList.video"
              controls
              class="fit_video"
            ></video>
          </div>
        </div>
      </div>
      <v-bottom-bar></v-bottom-bar>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propsList: {
      default: {}
    }
  }
};
</script>

