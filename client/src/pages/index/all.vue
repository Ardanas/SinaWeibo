<template>
  <div>
    <!-- 发表框 -->
    <div class="publish">
      <div class="pub_title clearfix">
        <div class="tit fl">
          <img src alt>
        </div>
        <div class="textNum" v-show="content.length>0">
          <p v-if="content.length<=5000">
            已输入
            <em class="num" :class="[content.length>140?'outWordStyle':'']">{{content.length}}</em>字
          </p>
          <p v-else>
            已超出
            <em class="num outWordStyle">{{5000-content.length}}</em>字
          </p>
        </div>
      </div>
      <div class="pub_text">
        <textarea class="w_input" rows="4" cols="40" v-model="content" title="看点输入框"></textarea>
      </div>
      <div class="pub_tool clearfix">
        <div class="tool fl">
          <ul>
            <li>
              <a href="#" class="kind biaoqing" @click="showEmoji = !showEmoji">表情</a>
              <el-popover
                placement="bottom"
                title
                :width="emojiWidth"
                trigger="manual"
                :offset="60"
                v-model="showEmoji"
              >
                <div class="el-icon-close close-icon" @click="showEmoji = !showEmoji"></div>
                <div>
                  <v-emoji @select="selectEmoji"></v-emoji>
                </div>
              </el-popover>
            </li>
            <li>
              <el-popover
                placement="bottom"
                title="上传图片"
                :width="picWidth"
                trigger="manual"
                :offset="60"
                v-model="visible"
              >
                <div class="el-icon-close close-icon" @click="visible = !visible"></div>
                <el-upload
                  action="/vp/File/vp/controller/text.php"
                  list-type="picture-card"
                  accept="image/*"
                  :limit="imgLimit"
                  :multiple="true"
                  :on-preview="handlePictureCardPreview"
                  :on-remove="handleRemove"
                  :on-exceed="handleExceed"
                  :on-error="uploadError"
                  :auto-upload="false"
                  :on-change="handlePicChange"
                  :http-request="uploadImgFile"
                  :data="reqData"
                  ref="upload"
                >
                  <i class="el-icon-plus"></i>
                  <div class="el-upload__tip" slot="tip">只能上传图片文件，且不超过2M</div>
                </el-upload>
                <el-dialog :visible.sync="dialogVisible">
                  <img width="100%" :src="dialogImageUrl" alt>
                </el-dialog>
                <span slot="reference">
                  <a href="#" class="kind img" @click="openPicPopover">图片</a>
                </span>
              </el-popover>
            </li>
            <li>
              <el-popover
                placement="bottom"
                title="上传视频"
                :width="videoWidth"
                trigger="manual"
                :offset="60"
                v-model="showVideo"
              >
                <div class="el-icon-close close-icon" @click="showVideo = !showVideo"></div>
                <el-upload
                  action="/vp/controller/addSpin.php"
                  accept="video/*"
                  :show-file-list="true"
                  :on-preview="handleVideoPreview"
                  :on-remove="handleRemoveVideo"
                  :on-error="uploadError"
                  :on-progress="uploadVideoProcess"
                  :on-change="handleVideoChange"
                  :auto-upload="false"
                  :http-request="uploadVideoFile"
                  :drag="true"
                  :data="reqData"
                  ref="uploadVideo"
                >
                  <video :src="dialogVideoUrl" v-if="dialogVideoUrl" width="100%" alt></video>
                  <i v-else class="el-icon-plus"></i>
                  <el-progress v-if="videoFlag" type="circle" :percentage="videoUploadPercent"></el-progress>
                  <div class="el-upload__tip" slot="tip">只能上传单个Mp4、Ogg格式视频文件，且不超过5M</div>
                </el-upload>
                <el-dialog :visible.sync="dialogVideoVisible">
                  <video :src="dialogVideoUrl" width="100%" alt></video>
                </el-dialog>
                <span slot="reference">
                  <a href="#" class="kind video" @click="openVideoPopover">视频</a>
                </span>
              </el-popover>
            </li>
            <li>
              <a href="#" class="kind talk">话题</a>
            </li>
            <li>
              <a href="#" class="kind tit_text">头条文章</a>
            </li>
          </ul>
        </div>

        <div class="public fr clear">
          <div class="send fr" :class="[content.length>0?'sendBtnHover':'']" @click="publishMsg">
            <a href="#">发布</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 中间导航 -->
    <div class="centerNav clearfix">
      <div class="nav_list fl">
        <div class="jiantou" ref="arrow"></div>
        <div class="centerNav_list">
          <ul>
            <li v-for="(item, index) in tagList" :key="index">
              <a
                href="javascript:void(0);"
                @click="toTag(index, item.path)"
                :class="[index === nowIndex?'active':'']"
              >{{item.value}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- 微博内容 -->
    <el-collapse-transition>
      <keep-alive>
        <router-view></router-view>
      </keep-alive>
    </el-collapse-transition>
    <!-- loading内容 
    <div class="loading">
      <div class="loadingText">
        <p>正在加载中，请稍侯...</p>
      </div>
    </div>
    -->
  </div>
  <!-- 右侧 -->
</template>


<script>
import VEmoji from "../../components/emoji.vue";
export default {
  data() {
    return {
      nowIndex: 0,
      nowMovieIndex: 0,
      noveltyList: {},
      content: "",
      tagList: [
        {
          id: 0,
          value: "全部",
          path: ""
        },
        {
          id: 1,
          value: "文字",
          path: "is_word"
        },
        {
          id: 2,
          value: "图片",
          path: "is_pic"
        },
        {
          id: 3,
          value: "视频",
          path: "is_video"
        }
      ],
      dialogImageUrl: "",
      dialogVideoUrl: "",
      dialogVisible: false,
      dialogVideoVisible: false,
      picWidth: 280,
      emojiWidth: 387,
      videoWidth: 387,
      imgLimit: 9,
      visible: false,
      htmlContent: "",
      showEmoji: false,
      showVideo: false,
      emojiValue: "",
      videoFlag: false,
      videoUploadPercent: "0%",
      formData: null,
      videoFormData: null,
      uploadPicLength: 0,
      uploadVideoLength: 0
    };
  },
  components: {
    VEmoji
  },
  computed: {
    reqData() {
      return {
        resList: []
      };
    }
  },
  methods: {
    toTag(index, path) {
      this.nowIndex = index;
      let i = index + 1;
      //修改箭头样式
      this.$refs.arrow.style.left = `${18 + index * 53}px`;
      //路由跳转
      let tagPath = path ? `/index/u/1/home/${path}=${i}` : `/index/u/1/home`;
      this.$router.push({ path: tagPath });
    },
    changeTagStatus() {
      let i = this.$route.params.index_type_id;
      this.nowIndex = i ? i - 1 : 0;
      this.$refs.arrow.style.left = `${18 + (i - 1) * 53}px`;
    },
    openPicPopover() {
      //console.log(this.uploadPicLength);
      if (this.uploadVideoLength > 0) {
        //用户选择了视频文件
        //提醒用户是否确定放弃上传视频
        this.$confirm("确定是否放弃上传视频", "提示", {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
          type: "warning"
        })
          .then(() => {
            this.$refs.uploadVideo.clearFiles(); //清空视频选择的文件
            this.showVideo = false; //关闭popover
            this.uploadVideoLength = 0; //清空长度
          })
          .catch(() => {
            console.log("cancel");
          });
      } else {
        this.showVideo = false;
        this.visible = !this.visible;
      }
    },
    openVideoPopover() {
      if (this.uploadPicLength > 0) {
        //用户选择了视频文件
        //提醒用户是否确定放弃上传视频
        this.$confirm("确定是否放弃上传图片", "提示", {
          confirmButtonText: "确定",
          cancelButtonText: "取消",
          type: "warning"
        })
          .then(() => {
            this.$refs.upload.clearFiles(); //清空视频选择的文件
            this.visible = false; //关闭popover
            this.uploadPicLength = 0; //清空长度
          })
          .catch(() => {
            console.log("cancel");
          });
      } else {
        this.showVideo = !this.showVideo;
        this.visible = false;
      }
    },
    handleRemove(file, fileList) {
      this.uploadPicLength = fileList.length;
    },
    handleRemoveVideo(file, fileList) {
      this.uploadVideoLength = fileList.length;
    },
    handlePictureCardPreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
    },
    handleVideoPreview(file) {
      console.log("handleVideoPreview");
      this.dialogVideoUrl = file.url;
      this.dialogVideoVisible = true;
    },
    uploadError(e, file, fileList) {
      this.$refs.upload.clearFiles();
      this.$message.error("上传失败，服务器错误");
    },
    handleExceed(file, fileList) {
      //图片上传超过数量限制
      console.log(fileList);
      this.$message.error("上传图片不能超过9张!");
      //console.log(file, fileList);
    },
    handlePicChange(file, fileList) {
      console.log(fileList.length);
      this.uploadPicLength = fileList.length;
    },
    handleVideoChange(file, fileList) {
      console.log(fileList.length);
      this.uploadVideoLength = fileList.length;
    },
    beforeImgsUpload(file) {
      //文件上传之前调用做一些拦截限制
      //console.log(file);
      const imgsType = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
      const isType = imgsType.indexOf(file.type) > -1;
      const isLt2M = file.size / 1024 / 1024 < 2; //除法运算，
      if (!isType) {
        this.$message.error("请上传图片类型的文件");
        return;
      } else if (!isLt2M) {
        this.$message.error("上传图片大小不能超过 2MB!");
        return;
      }
      //before-upload这个钩子return fasle的话，文件会停止上传的
      return isLt2M && isType;
    },
    uploadImgFile(file) {
      //有文件才执行
      //console.log("xx");
      let status = this.beforeImgsUpload(file.file);
      if (status) {
        this.formData.append("filesPicture[]", file.file); //多个文件已经要 files[]
      }
    },
    beforeVideoUpload(file) {
      //文件上传之前调用做一些拦截限制
      console.log(file);
      const isType = file.type == "video/mp4";
      const isLt2M = file.size / 1024 / 1024 < 5; //除法运算，
      if (!isType) {
        this.$message.error("请上传视频类型文件");
        return;
      } else if (!isLt2M) {
        this.$message.error("上传视频大小不能超过 5MB!");
        return;
      }
      return isLt2M && isType;
    },
    uploadVideoFile(file) {
      let status = this.beforeVideoUpload(file.file);
      if (status) {
        this.formData.append("filesVideo", file.file); //多个文件已经要 files[]
      }
    },
    uploadVideoProcess(event, file, fileList) {
      this.videoFlag = true;
      this.videoUploadPercent = Number(file.percentage.toFixed(2));
    },
    handleVideoSuccess(res, file) {
      //获取上传图片地址
      this.videoFlag = false;
      this.videoUploadPercent = 0;
      if (res.status == "200") {
        console.log(res.datas);
        //this.videoForm.videoUploadId = res.data.uploadId;
        //this.videoForm.Video = res.data.uploadUrl;
      } else {
        this.$message.error("视频上传失败，请重新上传！");
      }
    },
    publishMsg() {
      if (this.content == "" && this.content.length <= 0) {
        return;
      } else {
        this.htmlContent = this.content.replace(/\n/g, "<br/>");
        //let formData = new FormData();
        //this.formData = formData;
        this.formData.append("content", this.htmlContent);
        this.$refs.upload.submit();
        this.$refs.uploadVideo.submit();
        this.$api
          .addUserVp({
            url: "/controller/text.php",
            data: this.formData
          })
          .then(
            res => {
              console.log(res);
              if (res.data.status == 200) {
                this.$message.success(res.data.message);
                this.content = "";

                if (
                  this.formData.get("filesPicture[]") ||
                  this.formData.get("filesVideo")
                ) {
                  //只有在图片和视频才关闭弹窗
                  this.visible = !this.visible;
                  this.$refs.upload.clearFiles();
                  this.$refs.uploadVideo.clearFiles();
                }

                this.formData = new FormData(); //清空数据
              } else {
                this.$message.warning("服务器错误!!");
              }
            },
            err => {
              console.log(err);
            }
          );
      }
    },
    selectEmoji(code) {
      this.showEmoji = false;
      this.content += code;
    }
  },
  mounted() {
    this.changeTagStatus();
    this.formData = new FormData();
  },
  watch: {
    $route: "changeTagStatus"
  }
};
</script>

<style>
.el-upload--picture-card {
  width: 80px;
  height: 80px;
  line-height: 90px;
}
.el-upload-list--picture-card .el-upload-list__item {
  width: 80px;
  height: 80px;
}
.close-icon {
  display: inline-block;
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 20px;
  cursor: pointer;
}
.outWordStyle {
  color: #f90;
}
</style>


