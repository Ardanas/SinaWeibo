<template>
  <el-container>
    <el-main>
      <el-row>
        <el-col :span="24">
          <h1 class="Font Mar_10">完善个人信息</h1>
        </el-col>
        <el-col :span="8">
          <el-form
            ref="form"
            :model="profileForm"
            label-width="100px"
            size="small"
            label-position="left"
            status-icon
          >
            <el-form-item label="性别">
              <el-radio-group v-model="profileForm.sex">
                <el-radio label="男"></el-radio>
                <el-radio label="女"></el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="年龄">
              <el-input v-model.number="profileForm.age"></el-input>
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
              <el-input v-model="profileForm.motto"></el-input>
            </el-form-item>
            <el-form-item label="自我介绍">
              <el-input type="textarea" v-model="profileForm.intro"></el-input>
            </el-form-item>
            <el-form-item label="自定义封面图">
              <el-upload
                class="avatar-uploader"
                action="#"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :before-upload="beforeAvatarUpload"
              >
                <img v-if="profileForm.avatarUrl" :src="avatarUrl" class="avatar">
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </el-form-item>
            <el-form-item label="自定义背景图">
              <el-upload
                class="avatar-uploader"
                action="#"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :before-upload="beforeAvatarUpload"
              >
                <img v-if="profileForm.avatarUrl" :src="avatarUrl" class="avatar">
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </el-form-item>
            <el-form-item label="用户头像">
              <el-upload
                class="avatar-uploader"
                action="#"
                :show-file-list="false"
                :on-success="handleAvatarSuccess"
                :before-upload="beforeAvatarUpload"
              >
                <img v-if="profileForm.avatarUrl" :src="avatarUrl" class="avatar">
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </el-form-item>
            <el-form-item>
              <el-button type="primary">立即创建</el-button>
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
      profileForm: {
        age: 0,
        sex: "",
        phone: 0,
        motto: "",
        intro: "",
        city: [],
        options: [
          {
            value: "GD",
            label: "广东省",
            children: [
              {
                value: "yueixu",
                label: "越秀区"
              },
              {
                value: "zhiwan",
                label: "荔湾区"
              },
              {
                value: "haizhu",
                label: "海珠区"
              },
              {
                value: "tianhe",
                label: "天河区"
              },
              {
                value: "baiyun",
                label: "白云区"
              },
              {
                value: "huangpu",
                label: "黄埔区"
              },
              {
                value: "fanyu",
                label: "番禺区"
              },
              {
                value: "huadu",
                label: "花都区"
              },
              {
                value: "nansha",
                label: "南沙区"
              },
              {
                value: "luogang",
                label: "萝岗区"
              },
              {
                value: "zengchen",
                label: "增城市"
              },
              {
                value: "conghua",
                label: "从化市"
              },
              {
                value: "other",
                label: "其他"
              }
            ]
          },
          {
            value: "zujian",
            label: "组件"
          },
          {
            value: "ziyuan",
            label: "资源",
            children: [
              {
                value: "axure",
                label: "Axure Components"
              },
              {
                value: "sketch",
                label: "Sketch Templates"
              },
              {
                value: "jiaohu",
                label: "组件交互文档"
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

<style>
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
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
</style>

