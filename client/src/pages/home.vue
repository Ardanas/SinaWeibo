<template>
  <div class="lmlblog-member-main" data="1">
    <div class="lmlblog-member-bg">
      <div class="lmlblog-member-content">
        <div class="lmlblog-member-header">
          <div class="lmlblog-member-avatar other">
            <img
              :src="coverUrl"
              class="avatar"
            >
            <i class="lmlblog-verify lmlblog-verify-a" :title="userInfo.u_name"></i>
          </div>
          <div class="lmlblog-member-username">
            <h1>{{userInfo.u_name}}</h1>
            <span class="lmlblog-mark lmlblog-girl">
              <i class="fa fa-mars"></i>
            </span>
            <span class="lmlblog-mark lmlblog-lv" >Lv.6</span>
            <span class="lmlblog-mark lmlblog-vip">VIP 6</span>
          </div>
          <div class="lmlblog-member-desc">{{userInfo.u_motto?userInfo.u_motto:''}}</div>
          <div class="lmlblog-member-follow-info">
            <a href="#" target="_blank" rel="nofollow">
              <span class="follow no opacity">
                <i class="lmlblog-icon"></i>+ 关注
              </span>
            </a>
            <span class="opacity">
              <i class="lmlblog-icon">&#xe612;</i> 私聊
            </span>
          </div>
        </div>

        <div class="lmlblog-member-menu clear">
          <li
            v-for="(item, index) in homeNavList"
            :key="index"
            :class="[nowIndex===index?'on': '']"
            @click="toNavDetail(index, item.value)"
          >{{item.label}}</li>
        </div>
        <div class="lmlblog-member-content-list clear">
          <div class="lmlblog-member-left">
            <div class="lmlblog-member-left-follow clear">
              <li>
                <strong>168</strong>
                <span>关注</span>
              </li>
              <li>
                <strong>666</strong>
                <span>粉丝</span>
              </li>
              <li>
                <strong>888</strong>
                <span>喜欢</span>
              </li>
              <li>
                <strong>888888</strong>
                <span>人气</span>
              </li>
            </div>
            <div class="lmlblog-member-left-bg-music clear">
              <h3>背景音乐</h3>
              <div id="lmlblog-memeber-bg-music" class="aplayer"></div>
              <img
                src="http://wx2.sinaimg.cn/large/9c774d91gy1ft4lhr5vbmg20jp08okbw.gif"
                tppabs="http://wx2.sinaimg.cn/large/9c774d91gy1ft4lhr5vbmg20jp08okbw.gif"
                :alt="userInfo.u_name"
              >
              <audio
                src="https://img.jinsom.cn/user_files/12551/bg-music/music_1530776683.mp3"
                tppabs="https://img.jinsom.cn/user_files/12551/bg-music/music_1530776683.mp3"
                autoplay
                controls
              ></audio>
            </div>
            <div class="lmlblog-member-left-profile">
              <h3>资料简介</h3>
              <li>
                <i class="fa fa-address-book-o"></i> I D：
                <span>{{userInfo.u_name}}</span>
              </li>
              <li>
                <i class="fa fa-transgender"></i> 性别：
                <span>{{userInfo.u_sex}}</span>
              </li>
              <li>
                <i class="fa fa-map-marker"></i> 城市：
                <span>{{userInfo.u_city}}</span>
              </li>
              <li>
                <i class="fa fa-smile-o"></i> 签名：
                <span>{{userInfo.u_motto?userInfo.u_motto:''}}</span>
              </li>
              <div class="lmlblog-member-left-profile-hide" style="display:block;"
              v-show="showPersonal">
                <li>
                  <i class="fa fa-qq"></i> Q Q：
                  <span>{{userInfo.u_motto?userInfo.u_motto:''}}</span>
                </li>
                <li>
                  <i class="fa fa-wechat"></i> 微信：
                  <span>{{userInfo.u_name}}微信</span>
                </li>
                <li>
                  <i class="fa fa-weibo"></i> 微博：
                  <span>{{userInfo.u_name}}}微博</span>
                </li>
                <li>
                  <i class="fa fa-clock-o"></i> 生日：
                  <span>{{userInfo.u_birth}}</span>
                </li>
              </div>
              <div class="lmlblog-member-left-profile-more" @click="showPersonal = !showPersonal">
                查看更多
                <i class="fa fa-angle-right"></i>
              </div>
            </div>
          </div>

          <div class="lmlblog-member-right">
            <el-collapse-transition>
              <keep-alive>
                <router-view></router-view>
              </keep-alive>
            </el-collapse-transition>
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
      userInfo: {},
      showPersonal: false,
      coverUrl: "",
      nowIndex: 0,
      homeNavList: [
        {
          value: "all",
          label: "我的主页"
        },
        {
          value: "album",
          label: "我的相册"
        },
        {
          value: "profile",
          label: "个人档"
        },
        {
          value: "setting",
          label: "空间装扮"
        }
      ]
    };
  },
  methods: {
    toNavDetail(index, path) {
      this.nowIndex = index;
      this.$router.push({ path: `/home/${path}` });
    },
    changeTagStatus() {
      if (this.$route.meta.hid) {
        this.nowIndex = this.$route.meta.hid;
      }
    },
    getUserHomeMsg() {
      this.$api.getUserHomeMsg().then(
        res => {
          console.log(res);
          let items = res.data.datas;
          this.userInfo = items.personMessage[0];
          this.publishMessage = items.personPublish;
          this.coverUrl = this.$HOST + items.personMessage[0].u_cover.substring(2)
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
  created() {
    this.changeTagStatus();
    this.getUserHomeMsg();
  }
};
</script>

<style>
.avatar-uploader2 .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 50%;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}

.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 3px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}

.bg-cover {
  width: 100%;
  display: block;
}
</style>









