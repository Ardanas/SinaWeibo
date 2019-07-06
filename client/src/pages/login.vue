<template>
  <div class="login-container">
    <div class="main clearfix" id="plc_frame">
      <div class="fream">
        <!-- 左导 -->
        <div class="main_l">
          <div class="wb_left_nav">
            <div class="unlogin_left_nav">
              <div class="WB_main_l">
                <div id="pl_unlogin_home_leftnav">
                  <div class="UG_left_nav" node-type="UG_fixed_nav">
                    <ul>
                      <li @click="toTag(index)" v-for="(item, index) in tagList" :key="index">
                        <a
                          href="#"
                          class="nav_item"
                          :class="[index===nowIndex?'cur':'']"
                        >{{item.value}}</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /左导 -->
        <div id="plc_main">
          <div class="main_r">
            <!--登录框-->
            <div class="main_r_t">
              <div class="w_unlogin_v2">
                <div class="login_box">
                  <div class="login_innerwrap">
                    <div class="info_header">
                      <div class="tab clearfix">
                        <a
                          href="#"
                          class="w_fb"
                          @click="showLoginBox"
                          :class="[isLoginBox?'cur':'cur2']"
                        >帐号登录</a>
                        <a
                          href="#"
                          class="w_fb"
                          @click="showResgBox"
                          :class="[!isLoginBox?'cur':'cur2']"
                        >注册帐号</a>
                        <a href="#" class="qrcode_target qrcode_phone"></a>
                      </div>
                    </div>
                    <!-- 登录框 -->
                    <div class="W_login_form" v-show="isLoginBox">
                      <el-form
                        ref="loginForm"
                        :model="loginForm"
                        size="small"
                        :hide-required-asterisk="true"
                        :show-message="false"
                        :rules="loginRules"
                      >
                        <el-form-item prop="login_username" style="margin-bottom: 10px;">
                          <el-input
                            v-model="loginForm.login_username"
                            placeholder="请输入用户名"
                            prefix-icon="el-icon-user"
                          ></el-input>
                        </el-form-item>
                        <el-form-item prop="login_password" style="margin-bottom: 10px;">
                          <el-input
                            type="password"
                            v-model="loginForm.login_password"
                            autocomplete="off"
                            placeholder="请输入密码"
                            show-password
                            prefix-icon="el-icon-pass"
                          ></el-input>
                        </el-form-item>
                      </el-form>
                      <div class="info_list auto_login clearfix">
                        <div class="right w_fr">
                          <a href="#" class="S_txt2">忘记密码</a>
                        </div>
                        <label class="w_fl w_label" title="建议在网吧或公共电脑上取消该选项">
                          <input type="checkbox" class="W_checkbox">
                          <span class="S_txt2">记住我</span>
                        </label>
                      </div>
                      <div class="info_list login_btn">
                        <a href="#" class="w_btn_a btn_32px" @click="submitLoginForm('loginForm')">
                          <span>登录</span>
                        </a>
                      </div>
                      <div class="info_list register">
                        <span class="s_txt2">还没有看点？</span>
                        <a class="red" href="#" @click="showResgBox">立即注册！</a>
                      </div>
                    </div>

                    <!-- 注册框 -->
                    <div class="W_login_form" v-show="isResgBox">
                      <el-form
                        ref="resgForm"
                        :model="resgForm"
                        label-width="80px"
                        label-position="left"
                        :rules="resgRules"
                        status-icon
                        size="small"
                        :inline-message="true"
                      >
                        <el-form-item label="用户名" prop="resg_username">
                          <el-input v-model="resgForm.resg_username" placeholder="请输入6-16位用户名"></el-input>
                        </el-form-item>
                        <el-form-item label="密码" prop="resg_password">
                          <el-input
                            type="password"
                            v-model="resgForm.resg_password"
                            autocomplete="off"
                            placeholder="6-20位大小写字母和数字"
                            show-password
                          ></el-input>
                        </el-form-item>
                        <el-form-item label="确认密码" prop="resg_repassword">
                          <el-input
                            type="password"
                            v-model="resgForm.resg_repassword"
                            autocomplete="off"
                            placeholder="6-20位大小写字母和数字"
                            show-password
                          ></el-input>
                        </el-form-item>
                        <el-form-item label="邮箱" prop="resg_email">
                          <el-input v-model="resgForm.resg_email" placeholder="请输入邮箱"></el-input>
                        </el-form-item>
                        <div class="info_list login_btn">
                          <a href="#" class="w_btn_a btn_32px" @click="submitResgForm('resgForm')">
                            <span>注册</span>
                          </a>
                        </div>
                      </el-form>
                    </div>
                    <!-- 短信登录 -->
                    <div class="info_list other_login clearfix">
                      <span class="w_fl s_txt2">其他登录：</span>
                      <div class="other_login_list w_fl">
                        <a target="_blank" href="#" class="cp_logo icon_tb"></a>
                        <a target="_blank" href="#" class="cp_logo icon_qq"></a>
                        <a target="_blank" href="#" class="cp_logo icon_yidong"></a>
                        <a target="_blank" href="#" class="cp_logo icon_tianyi"></a>
                        <a target="_blank" href="#" class="cp_logo icon_360"></a>
                        <a target="_blank" href="#" class="cp_logo icon_unicom"></a>
                        <a target="_blank" href="#" class="cp_logo icon_baidu"></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--看点新鲜事-->
            <div id="pl_unlogin_home_hot">
              <v-hot-topic></v-hot-topic>
            </div>
            <!--热映电影-->
            <div id="pl_unlogin_home_hot">
              <v-hot-movie></v-hot-movie>
            </div>
            <!--微博找人-->
            <div id="pl_unlogin_home_find">
              <div class="wb_cardwrap s_bg3">
                <div class="wb_cardtitle_b s_line2">
                  <h2 class="main_title W_fb W_f14">
                    微博找人
                    <span class="el-icon-error"></span>
                  </h2>
                </div>
                <div class="wb_innerwrap">
                  <div class="m_wrap clearfix">
                    <div class="list_wrap1">
                      <h3 class="text_title">名人</h3>
                      <ul class="ul_text clearfix">
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_1003_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_892_1003_0.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">明星</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_1001_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_892_1001_0.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">商界</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5007_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_892_1007_0.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">媒体精英</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_1003_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_892_1005_0.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">作家</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_1003_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_892_1004_0.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">政府官员</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="m_wrap clearfix">
                    <div class="list_wrap">
                      <h3 class="text_title">专家</h3>
                      <ul class="ul_text clearfix">
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_2017_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_2017.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">医疗</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_2018_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_2018.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">育儿</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5002_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5002.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">IT互联网</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5012_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5012.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">电台</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5001_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5001.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">财经</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_2016_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_2016.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">教育</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5013_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5013.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">法律</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_2014_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_2014.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">美妆</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_2024_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_854_2024_0.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">艺术</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5015_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5015.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">设计</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5005_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5005.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">房产家装</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a
                            target="_blank"
                            href="http://d.weibo.com/1087030002_2975_5006_0"
                            class="tlink s_txt1"
                          >
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5006.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">汽车</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a target="_blank" href="#" class="tlink s_txt1">
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5008.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">交通</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a target="_blank" href="#" class="tlink s_txt1">
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_2013.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">职业招聘</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a target="_blank" href="#" class="tlink s_txt1">
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5011.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">婚庆</span>
                          </a>
                        </li>
                        <li class="li_text">
                          <a target="_blank" href="#" class="tlink s_txt1">
                            <i class="item_icon">
                              <img
                                src="http://img.t.sinajs.cn/t6/style/images/connect/finder/1087030002_558_3_5014.png"
                                class="pic"
                              >
                            </i>
                            <span class="text width_fix W_autocut">宗教</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <el-collapse-transition>
            <keep-alive>
              <router-view></router-view>
            </keep-alive>
          </el-collapse-transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VHotTopic from "../components/hotTopic";
import VHotMovie from "../components/hotMovie";

export default {
  components: {
    VHotTopic,
    VHotMovie
  },
  data() {
    // 用户名
    const validateUsername = (rule, value, callback) => {
      if (/^[a-zA-Z0-9_-]{4,16}$/.test(value) == false) {
        callback(new Error("请输入长度为4-16位用户名"));
      } else {
        if (this.isUserRepeat) {
          callback(new Error("该用户名已存在"));
        } else {
          callback();
        }
      }
    };
    // 密码
    const validatePass = (rule, value, callback) => {
      if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{6,20}$/.test(value) == false) {
        callback(new Error("长度6-20位，必须包含大小写字母和数字"));
      } else {
        callback();
      }
    };
    // 确认密码
    const validateRePass = (rule, value, callback) => {
      if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{6,20}$/.test(value) == false) {
        callback(new Error("长度6-20位，必须包含大小写字母和数字"));
      } else if (value !== this.resgForm.resg_password) {
        callback(new Error("两次输入密码不一致!"));
      } else {
        callback();
      }
    };
    // 邮箱
    const validateEamil = (rule, value, callback) => {
      if (
        /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/.test(
          value
        ) == false
      ) {
        callback(new Error("请输入正确格式的邮箱"));
      } else {
        callback();
      }
    };
    return {
      nowIndex: 0,
      tagList: [
        {
          id: 0,
          value: "热门"
        },
        {
          id: 1,
          value: "本地新闻"
        },
        {
          id: 2,
          value: "视频"
        },
        {
          id: 3,
          value: "新鲜事"
        },
        {
          id: 4,
          value: "电影"
        },
        {
          id: 5,
          value: "体育"
        },
        {
          id: 6,
          value: "娱乐"
        },
        {
          id: 7,
          value: "科技"
        },
        {
          id: 8,
          value: "艺术"
        },
        {
          id: 9,
          value: "教育"
        }
      ],
      noveltyList: {},
      noveltyTime: "",
      hotMoviceList: {},
      isLoginBox: true,
      isResgBox: false,
      isUserRepeat: false,
      loginForm: {
        login_username: "",
        login_password: ""
      },
      resgForm: {
        resg_username: "",
        resg_password: "",
        resg_repassword: "",
        resg_email: ""
      },
      loginRules: {
        login_username: [{ required: true, message: "sxx" }],
        login_password: [{ required: true }]
      },
      resgRules: {
        resg_username: [
          { required: true, message: "请输入用户名", trigger: "blur" },
          { validator: validateUsername, trigger: "blur" }
        ],
        resg_password: [
          { required: true, message: "请输入密码", trigger: "blur" },
          {
            validator: validatePass,
            trigger: "blur"
          }
        ],
        resg_repassword: [
          { required: true, message: "请输入密码", trigger: "blur" },
          {
            validator: validateRePass,
            trigger: "blur"
          }
        ],
        resg_email: [
          { required: true, message: "请输入邮箱", trigger: "blur" },
          { validator: validateEamil, trigger: "blur" }
        ]
      }
    };
  },
  methods: {
    messageShow(message, type = "success") {
      this.$message({
        message,
        type
      }); //弹出消息框
    },
    toTag(index) {
      console.log("index" + index);
      this.nowIndex = index;
      let i = index + 1;
      this.$router.push({ path: `/tag${i}/${i}` });
    },
    toArticleDetail(aid) {
      console.log(aid);
      this.$router.push({ path: `/tag4/4/detail/${aid}` });
    },
    toMoviceDetail() {
      this.$router.push({ path: `/tag5/5` });
    },
    showLoginBox() {
      this.isLoginBox = true;
      this.isResgBox = false;
    },
    showResgBox() {
      this.isResgBox = true;
      this.isLoginBox = false;
    },
    submitResgForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          //网络请求，发送数据
          this.$api
            .registerUser({
              username: this.resgForm.resg_username,
              password: this.resgForm.resg_password,
              email: this.resgForm.resg_email
            })
            .then(
              res => {
                console.log(res);
                if (res.data.status == 200) {
                  this.messageShow("注册成功,赶紧去登录吧！");
                  this.showLoginBox(); //显示登录界面
                  this.$refs[formName].resetFields(); //重置注册表单
                } else if (res.data.status == 500) {
                  this.messageShow(res.data.message, "warning");
                }
              },
              err => {
                console.log(err);
              }
            );
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    submitLoginForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          this.$api
            .login({
              username: this.loginForm.login_username,
              password: this.loginForm.login_password
            })
            .then(
              res => {
                console.log(res);
                if (res.data.status == 200) {
                  this.messageShow("登录成功");
                  this.$router.go({ path: "/index/u/1/home" });
                  let items = res.data.datas;
                  console.log(items)
                  this.$store.dispatch('login', items);

                } else if (res.data.status == 500) {
                  this.messageShow(res.data.message, "warning");
                }
              },
              err => {
                console.log(err);
              }
            );
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    changeTagStatus() {
      if (this.$route.params.id) {
        this.nowIndex = this.$route.params.id - 1;
      } else {
        this.nowIndex = 0;
      }
    }
  },
  watch: {
    $route: "changeTagStatus"
  },
  mounted() {
    /*this.$api.getNovelty().then(
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
        console.log(res);
      }
    );
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
              item.images.small = this.$utils.fixPic403(item.images.small);
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
    );*/
  },
  created() {
    this.changeTagStatus();
  }
};
</script>


