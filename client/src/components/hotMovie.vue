<template>
  <div class="wb_cardwrap s_bg3">
    <div class="wb_cardtitle_b s_line2">
      <h4 class="obj_name">
        <span class="main_title w_fb w_f14">正在上映电影</span>
      </h4>
    </div>
    <div class="wb_innerwrap">
      <div class="list_wrap2">
        <ul class="ul_text">
          <li
            class="li_text1 clearfix"
            v-for="(item, index) in hotMoviceList"
            :key="index"
            @click="toMoviceDetail"
          >
            <div class="w_fl" style="margin-right: 12px;">
              <img :src="item.images.small" alt width="50" height="50">
            </div>
            <div class="w_fl">
              <p :title="item.title" class="S_txt1 M_tit">{{item.title}}</p>
              <p :title="item.type" class="M_type">类型：{{item.type}}</p>
            </div>
            <div class="w_fr M_score">
              <p :title="item.rating.average">{{item.rating.average}}</p>
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
      hotMoviceList: {}
    };
  },
  methods: {
    toMoviceDetail() {
      this.$router.push({ path: `/tag5/5` });
    }
  },
  mounted() {
    this.$api.getTagFiveList().then(
      res => {
        console.log(res);
        const items = res.subjects;
        const newItems = [];
        //const items = res.subjects.find(item => item.rating.average > 0);//只会返回第一个
        //console.log(items);
        if (items.length !== 0) {
          items.forEach((item, index) => {
            if (item.rating.average !== 0) {
              //item.images.small = this.$utils.fixPic403(item.images.small);
              item.type = item.genres.join("/");
              newItems.push(items[index]);
            }
          });
          console.log(newItems);
          this.hotMoviceList = newItems;
        }
      },
      err => {
        console.log(err);
      }
    );
  }
};
</script>

