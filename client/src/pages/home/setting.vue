<template>
  <el-container>
    <el-main>
      <el-row>
        <el-col :span="24">
          <h1 class="Font Mar_b_10">个性空间装扮</h1>
        </el-col>
        <el-col :span="24">
          <el-form
            ref="form"
            :model="settingForm"
            label-width="200px"
            size="large"
            label-position="top"
          >
            <el-form-item label="自定义背景音乐">
              <el-upload
                class="upload-demo"
                action="#"
                :on-success="handleBgmSuccess"
                :before-upload="beforeBgmUpload"
              >
                <el-button size="large" type="primary">点击上传</el-button>
              </el-upload>
            </el-form-item>

            <el-form-item label="自定义封面图">
              <el-upload
                class="avatar-uploader"
                action="#"
                :show-file-list="false"
                :on-success="handleCoverSuccess"
                :before-upload="beforeCoverUpload"
              >
                <img :src="[settingForm.coverUrl?settingForm.coverUrl:baseCoverUrl]" class="bg-cover">
                <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
              </el-upload>
            </el-form-item>

            <el-form-item label="自定义背景图">
              <el-upload
                class="avatar-uploader"
                action="#"
                :show-file-list="false"
                :on-success="handleBgSuccess"
                :before-upload="beforeBgUpload"
              >
                <img :src="[settingForm.bgUrl?settingForm.bgUrl:baseBgUrl]" class="bg-cover">
                <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
              </el-upload>
            </el-form-item>
          </el-form>
        </el-col>
      </el-row>
    </el-main>
  </el-container>
</template>

<script>
export default {
  data() {
    return {
      baseBgUrl:
        "http://wx3.sinaimg.cn/large/9c774d91gy1ft2c2d2gz8j21e00qktt3.jpg",
      baseCoverUrl:
        "http://wx3.sinaimg.cn/large/9c774d91gy1ft2c2d2gz8j21e00qktt3.jpg",
      baseBgmUrl:
        "https://img.jinsom.cn/user_files/12551/bg-music/music_1530776683.mp3",
      settingForm: {
        bgmUrl: "",
        coverUrl: "",
        bgUrl: ""
      }
    };
  },
  methods: {
    handleCoverSuccess(res, file) {
      this.settingForm.coverUrl = URL.createObjectURL(file.raw);
    },
    beforeCoverUpload(file) {
      const isJPG = file.type === "image/jpeg";
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error("上传头像图片只能是 JPG 格式!");
      }
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
      }
      return isJPG && isLt2M;
    },
    handleBgSuccess(res, file) {
      this.settingForm.bgUrl = URL.createObjectURL(file.raw);
    },
    beforeBgUpload(file) {
      const isJPG = file.type === "image/jpeg";
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error("上传头像图片只能是 JPG 格式!");
      }
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
      }
      return isJPG && isLt2M;
    },
    handleBgmSuccess(res, file) {
      this.settingForm.bgmUrl = URL.createObjectURL(file.raw);
    },
    beforeBgmUpload(file) {
      const isJPG = file.type === "image/jpeg";
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error("上传头像图片只能是 JPG 格式!");
      }
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
      }
      return isJPG && isLt2M;
    }
  }
};
</script>
