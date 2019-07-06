<template>
  <el-container>
    <el-main>
      <el-row>
        <el-col :span="24">
          <h1 class="Font Mar_b_10">完善个人信息</h1>
        </el-col>
        <el-col :span="14">
          <el-form
            ref="form"
            :model="profileForm"
            label-width="100px"
            size="small"
            label-position="left"
            status-icon
          >
            <el-form-item label="用户头像">
              <el-upload
                class="avatar-uploader2"
                action="/vp/File/vp/controller/text.php"
                accept="image/*"
                :on-change="handlePicChange"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :auto-upload="false"
                :on-error="uploadError"
                :http-request="uploadAvatar"
                ref="uploadAvatar"
              >
                <img :src="profileForm.avatarUrl" class="avatar">
                <div class="el-upload__tip" slot="tip">Tip:点击修改头像</div>
              </el-upload>
            </el-form-item>
            <el-form-item label="性别">
              <el-radio-group v-model="profileForm.sex">
                <el-radio label="男"></el-radio>
                <el-radio label="女"></el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="生日">
              <el-date-picker
                v-model="profileForm.birthday"
                type="date"
                placeholder="选择日期"
                format="yyyy 年 MM 月 dd 日"
                value-format="yyyy-MM-dd"
              ></el-date-picker>
            </el-form-item>
            <el-form-item label="联系号码">
              <el-input v-model.number="profileForm.phone"></el-input>
            </el-form-item>
            <el-form-item label="城市">
              <el-cascader
                expand-trigger="hover"
                :options="profileForm.options"
                v-model="profileForm.city"
                @change="handleChange"
              ></el-cascader>
            </el-form-item>
            <el-form-item label="座右铭">
              <el-input type="textarea" v-model="profileForm.motto"></el-input>
            </el-form-item>
            <el-form-item label="自我介绍">
              <el-input type="textarea" v-model="profileForm.intro"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="submitPersonMsg">立即保存</el-button>
              <el-button>清空</el-button>
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
      userInfo: null,

      formData: null,
      baseAvatarUrl:
        "https://tvax4.sinaimg.cn/crop.0.0.888.888.180/006Dh9Zbly8ft1i9uqjjkj30oo0oo0ue.jpg",
      profileForm: {
        birthday: 0,
        sex: "男",
        phone: null,
        motto: "",
        intro: "",
        city: [],
        options: [
          {
            value: "GD",
            label: "广东省",
            children: [
              {
                value: "越秀区",
                label: "越秀区"
              },
              {
                value: "荔湾区",
                label: "荔湾区"
              },
              {
                value: "海珠区",
                label: "海珠区"
              },
              {
                value: "天河区",
                label: "天河区"
              },
              {
                value: "白云区",
                label: "白云区"
              },
              {
                value: "黄埔区",
                label: "黄埔区"
              },
              {
                value: "番禺区",
                label: "番禺区"
              },
              {
                value: "花都区",
                label: "花都区"
              },
              {
                value: "南沙区",
                label: "南沙区"
              },
              {
                value: "萝岗区",
                label: "萝岗区"
              },
              {
                value: "增城市",
                label: "增城市"
              },
              {
                value: "从化市",
                label: "从化市"
              },
              {
                value: "其他",
                label: "其他"
              }
            ]
          }
        ],
        avatarUrl: ""
      }
    };
  },
  methods: {
    handleChange(value) {
      console.log(value);
    },
    handleAvatarSuccess(res, file) {
      this.imageUrl = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      console.log(file);
      const imgsType = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
      const isType = imgsType.indexOf(file.type) > -1;
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isType) {
        this.$message.error("请上传图片类型的文件");
        return;
      } else if (!isLt2M) {
        this.$message.error("上传图片大小不能超过 2MB!");
        return;
      }
      return isType && isLt2M;
    },
    handlePicChange(file) {
      console.log("change");
      this.profileForm.avatarUrl = file.url;
    },
    uploadAvatar(file) {
      console.log(file)
      let status = this.beforeAvatarUpload(file.file);
      if (status) {
        this.formData.append("u_cover", file.file); //多个文件已经要 files[]
      }
    },
    submitPersonMsg() {
      let birthday = this.profileForm.birthday;
      let sex = this.profileForm.sex;
      let phone = this.profileForm.phone;
      let motto = this.profileForm.motto;
      let intro = this.profileForm.intro;
      let city = this.profileForm.city[1];
      this.$refs.uploadAvatar.submit();
      this.formData.append("birth", birthday);
      this.formData.append("sex", sex);
      this.formData.append("phone", phone);
      this.formData.append("motto", motto);
      this.formData.append("intro", intro);
      this.formData.append("city", city);
      if (
        birthday == "" ||
        sex == "" ||
        phone == "" ||
        motto == "" ||
        intro == "" ||
        city == ""
      ) {
        this.$message({
          message: "信息不能为空",
          type: "warning"
        });
        return;
      } else {
        this.$api
          .addUserProfile({
            url: "/controller/updateMessage.php",
            data: this.formData
          })
          .then(
            res => {
              console.log(res);
            },
            err => {
              console.log(err);
            }
          );
      }
    },
    getUserHomeMsg() {
      this.$api.getUserHomeMsg().then(
        res => {
          console.log(res);
          let items = res.data.datas.personMessage[0];
          console.log(items.u_sex)
          this.profileForm.birthday = items.u_birth;
          this.profileForm.sex = items.u_sex;
          this.profileForm.phone = items.u_phone;
          this.profileForm.motto = items.u_motto;
          this.profileForm.intro = items.u_intro;
          this.profileForm.city = [
            "GD",
            items.u_city
          ];

          this.profileForm.avatarUrl =
            this.$HOST + items.u_cover.substring(2);
        },
        err => {
          console.log(err);
        }
      );
    },
    uploadError(e, file, fileList) {
      //this.$refs.upload.clearFiles();
      this.$message.error("上传失败，服务器错误");
    },
  },
  created() {
    this.formData = new FormData();
    this.getUserHomeMsg()
  }
};
</script>


