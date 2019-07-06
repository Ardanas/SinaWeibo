<template>
  <div class="wb_cardwrap s_bg3">
    <div class="wb_cardtitle_b s_line2">
      <h4 class="obj_name">
        <span class="main_title w_fb w_f14">看点新鲜事</span>
      </h4>
    </div>
    <div class="wb_innerwrap">
      <div class="list_wrap2">
        <ul class="ul_text">
          <li
            class="li_text1 clearfix UG_list_d"
            v-for="(item, index) in noveltyList"
            :key="index"
            @click="toArticleDetail(item.id)"
          >
            <div class="pic W_piccut_v">
              <img :src="item.image" alt="图片加载失败">
            </div>
            <div class="list_des">
              <h3 class="list_title_s">
                <a href="#" class="S_txt1" :title="item.title">{{item.title}}</a>
              </h3>
              <div class="list_plus">
                <span class="list_text">{{noveltyTime}}</span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      noveltyList: {}
    };
  },
  methods: {
    toArticleDetail(aid) {
      console.log(aid);
      this.$router.push({ path: `/tag4/4/detail/${aid}` });
    }
  },
  mounted() {
    this.$api.getNovelty().then(
      res => {
        console.log(res.data);
        let items = res.data;
        this.noveltyTime = this.$utils.fixDate(items.date);
        for (let item of items.top_stories) {
          item.image = this.$utils.fixPic403(item.image);
        }
        this.noveltyList = items.top_stories;
      },
      err => {
        console.log(err);
      }
    );
  }
};
</script>

