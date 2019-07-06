<template>
  <!--2,3,5,6,9张图片-->
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
          <el-row :gutter="4" :class="[isClickPic?'w_100':'w_72']">
            <div v-if="!isClickPic">
              <el-col :span="8" v-for="(o, index) in propsList.picture" :key="index">
                <el-image
                  :src="$HOST + o.substring(2)"
                  fit="cover"
                  class="fit_img fit_img_9"
                  :class="[isClickPic?'small_mirror':'large_mirror']"
                  @click.native="togglePic(index)"
                >
                  <div slot="error" class="image-slot">
                    <i class="el-icon-picture-outline"></i>
                  </div>
                </el-image>
              </el-col>
            </div>
            <el-col :span="24" v-else>
              <el-carousel
                trigger="click"
                :autoplay="false"
                :height="height"
                :initial-index="initialIndex"
                indicator-position="outside"
                @change="changePic"
              >
                <el-carousel-item v-for="(o, index) in propsList.picture" :key="index">
                  <el-image
                    :src="$HOST + o.substring(2)"
                    fit="cover"
                    class="fit_img"
                    :class="[isClickPic?'small_mirror':'large_mirror']"
                    @click.native="togglePic()"
                  >
                    <div slot="error" class="image-slot">
                      <i class="el-icon-picture-outline"></i>
                    </div>
                  </el-image>
                </el-carousel-item>
              </el-carousel>
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
      height: "500px",
      isClickPic: false,
      initialIndex: 0,
      imgUrl: [
        {
          src:
            "https://wx3.sinaimg.cn/mw690/e72082c6gy1g35efnsuz1j20hs0hsq4k.jpg"
        },
        {
          src:
            "https://wx2.sinaimg.cn/mw690/941ff757ly1g38mswkkq7j20u011igti.jpg"
        },
        {
          src:
            "https://wx1.sinaimg.cn/mw690/67dd74e0gy1g3828jshhoj20j60piadl.jpg"
        },
        {
          src:
            "https://wx2.sinaimg.cn/mw690/0064QOFcly1g380swg6rej30h00jb7l1.jpg"
        },
        {
          src:
            "https://wx4.sinaimg.cn/mw690/006jfN7kgy1g3beaj8vy3j33gg56ou0y.jpg"
        },
        {
          src:
            "https://wx4.sinaimg.cn/mw690/006jfN7kgy1g3beakf1xhj356o3gge82.jpg"
        },
        {
          src:
            "https://wx3.sinaimg.cn/mw690/7049c17bly1g3bdccy26kj20u00u01ky.jpg"
        },
        {
          src:
            "https://wx2.sinaimg.cn/mw690/aeebd2e9gy1g36wr1e4muj20u00sse81.jpg"
        },
        {
          src:
            "https://wx4.sinaimg.cn/mw690/d7eb27e2gy1g3bb4wqivsj20gz75l1kx.jpg"
        }
      ]
    };
  },
  methods: {
    togglePic(index = 0) {
      this.initialIndex = index;
      this.isClickPic = !this.isClickPic;
    },
    changePic(i) {
      let img = new Image();
      img.src = this.$HOST + this.propsList.picture[i].substring(2)
      let w = img.width;
      let h = img.height;
      let h2 = Math.ceil(496 / (w / h));
      this.height = h2 + "px";
    }
  }
};
</script>