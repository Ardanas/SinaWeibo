<template>
  <div class="main clearfix">
    <div class="mainLeft fl">
      <div class="leftNav">
        <div class>
          <ul>
            <li v-for="(item, index) in tagList" :key="index">
              <a
                href="#"
                @click="toTag(index, item.path)"
                :class="[index === nowIndex?'clickHover':'']"
              >{{item.value}}</a>
            </li>
          </ul>
        </div>
        <div class="leftNav_line">
          <fieldset>
            <legend>
              <a href="#">
                <img src="../assets/img/guanli.png" alt>
              </a>
            </legend>
          </fieldset>
        </div>
        <div class="leftNav_b">
          <ul>
            <li v-for="item in tagList2" :key="item.id">
              <a
                href="#"
                @click="toTag(item.id, item.path)"
                :class="[item.id === nowIndex?'clickHover':'']"
              >
                <span :class="item.icon"></span>
                {{item.value}}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="mainRight fl clearfix m_l_150">
      <!--中间-->
      <div class="mainRight_l fl">
        <el-collapse-transition>
          <keep-alive>
            <router-view></router-view>
          </keep-alive>
        </el-collapse-transition>
      </div>

      <!-- 右侧 -->
      <div class="mainRight_r fl">
        <!-- 用户信息 -->
        <div class="userBox">
          <div class="userbg"></div>
          <div class="userImgBox">
            <router-link :to="{path:'/home'}" tag="a">
              <img :src="userMsg.u_cover" alt="Sakura" title="sakura">
            </router-link>
          </div>
          <div class="userInfo">
            <h3 class="userid">
              <a href="#">{{userMsg.u_name}}</a>
              <img src="../assets/img/vipIcon.jpg" alt>
            </h3>
            <em class="lv">LV.9</em>
            <div class="userInfo_list">
              <router-link :to="{path:'/index/fav/2'}" tag="span" class="fl userConern">
                <p>
                  <a href="#" class="num">397</a>
                </p>
                <p class="conern">收藏</p>
              </router-link>

              <router-link :to="{path:'/index/like/3'}" tag="span" class="fl line userFans">
                <p>
                  <a href="#" class="num">122</a>
                </p>
                <p class="fans">点赞</p>
              </router-link>

              <router-link :to="{path:'/home'}" tag="span" class="fl userWeibo">
                <p>
                  <a href="#" class="num">443</a>
                </p>
                <p class="weibo">微博</p>
              </router-link>
            </div>
          </div>
        </div>
        <!-- 电影热映榜 -->
        <div class="movieTalk">
          <div class="talkTit">
            <a href="#">微博电影热映榜</a>
          </div>
          <div class="movieList clearfix">
            <div
              class="movieTit clearfix"
              v-for="(item, index) in 3"
              :key="index"
              @mouseover="changeMovieTag(index)"
            >
              <div class="movieImg fl" :class="[nowMovieIndex===index?'':'none']">
                <a href="#">
                  <img src="../assets/img/movieImg.jpg" alt>
                </a>
              </div>
              <div class="movieInfo fl clearfix">
                <span
                  class="fl badge"
                  :style="{'background-color':index?'#fa7d3c':'#DF3E3E'}"
                >{{index+1}}</span>
                <p class="fl movieName_tit w_f14">
                  <a href="#" class="S_txt2">复仇者联盟xxxxxxxxxxxxxxxxxx</a>
                </p>
                <div class="actor" :class="[nowMovieIndex===index?'':'none']">
                  <p class="S_txt3">主演：汤唯/吴秀波</p>
                  <p class="S_txt3">类型：爱情</p>
                  <p class="S_txt3 w_f14">9.9分</p>
                </div>
              </div>
              <div class="movieScroe" :class="[nowMovieIndex===index?'none':'']">9.9</div>
            </div>
          </div>
          <div class="more">
            <a href="#">查看更多&gt;</a>
          </div>
        </div>
        <!-- 热门话题 -->
        <div class="hotTalk">
          <div class="talkTit">
            <a href="#">热门话题</a>
          </div>
          <div class="talkList">
            <ul>
              <li v-for="(item, index) in noveltyList" :key="index" class="Font Mar_b_10">
                <a href="#" :title="item.title" class="S_txt1"># {{item.title}}</a>
              </li>
            </ul>
          </div>
          <div class="more">
            <a href="#">查看更多&gt;</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      nowIndex: 0,
      nowMovieIndex: 0,
      noveltyList: {},
      noveltyTime: "",
      tagList: [
        {
          id: 0,
          value: "首页",
          path: "u"
        },
        {
          id: 1,
          value: "我的收藏",
          path: "fav"
        },
        {
          id: 2,
          value: "我的赞",
          path: "like"
        }
      ],
      tagList2: [
        {
          id: 3,
          value: "热门看点",
          icon: "el-icon-view",
          path: "hvp"
        },
        {
          id: 4,
          value: "热门视频",
          icon: "el-icon-video-camera-solid",
          path: "hv"
        }
      ],
      userMsg: {},
      publishMsg: []
    };
  },
  methods: {
    toTag(index, path) {
      this.nowIndex = index;
      let i = index + 1;
      this.$router.push({ path: `/index/${path}/${i}` });
    },
    changeTagStatus() {
      console.log(this.$route);
      this.nowIndex = this.$route.params.index_id - 1;
    },
    changeMovieTag(index) {
      this.nowMovieIndex = index;
    },
    getDataList() {
      this.$api.getNovelty().then(
        res => {
          console.log(res.data);
          let items = res.data;
          //this.noveltyTime = this.$utils.fixDate(items.date);
          for (let item of items.top_stories) {
            item.image = this.$utils.fixPic403(item.image);
          }
          this.noveltyList = items.top_stories;
        },
        err => {
          console.log(err);
        }
      );
    },
    getUserIndexMsg() {
      this.$api.getUserIndexMsg().then(
        res => {
          console.log(res);
          if (res.data.status == 200) {
            let items = res.data.datas;
            items.user[0].u_cover =
              this.$HOST + items.user[0].u_cover.substring(3);
            this.userMsg = items.user[0];
            this.publishMsg = items.mainMessage;
          }
        },
        err => {
          console.log(err);
        }
      );
    }
  },
  watch: {
    $route: "changeTagStatus"
  },
  computed: {
    userInfo() {
      return JSON.parse(sessionStorage.getItem("userInfo"));
    }
  },
  created() {
    this.changeTagStatus();
    this.getDataList();
    this.getUserIndexMsg();
  }
};
</script>

