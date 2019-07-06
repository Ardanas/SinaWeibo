<template>
  <div class="headerBox">
    <div class="header clearfix">
      <div class="logo fl">
        <a href="#">
          <img src="../assets/img/logo.jpg" alt>
        </a>
      </div>
      <div class="searchBox fl">
        <input type="text" class="search" value placeholder="大家正在搜:">
        <a href="#" class="searchImg">
          <img src="../assets/img/search.png" alt>
        </a>
      </div>

      <div class="navBox fl">
        <ul>
          <li class="home">
            <router-link :to="{path:'/index'}" tag="a" class="active">首页</router-link>
          </li>
          <li class="find">
            <a href="#">发现</a>
          </li>
          <li class="game">
            <a href="#">游戏</a>
          </li>
          <li class="user" v-if="userInfo">
            <router-link :to="{path:'/home'}" tag="a">{{userInfo.username}}</router-link>
          </li>
        <!--
          <li v-else style="display: inline-block;vertical-align: middle; ">
            <router-link :to="{path:'/'}" tag="a">注册</router-link>
            <span>|</span>
            <router-link :to="{path:'/'}" tag="a">登录</router-link>
          </li>
          -->
          <li class="exit" v-show="userInfo" @click="exit">
            <a href="#">退出</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style>
</style>

<script>
export default {
  data() {
    return {
      uid: 0
    };
  },
  computed: {
    userInfo() {
      return JSON.parse(sessionStorage.getItem("userInfo"));
    }
  },
  methods: {
    exit() {
      this.$api.logout().then(
        res => {
          console.log(res);
          if (res.data.status == 200) {
            this.$store.dispatch("logout");
            this.$message({
              message: "退出成功",
              type: "success"
            });
            this.$router.go({ path: "/tag1" });
          }
        },
        err => {
          this.$message({
            message: "服务器错误",
            type: "warning"
          });
        }
      );
    }
  }
};
</script>


