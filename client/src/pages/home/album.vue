<template>
  <el-container>
    <el-main>
      <el-row>
        <el-col :span="8" v-for="o in 6" :key="o" style="padding: 0 2px 4px 2px;">
          <el-card :body-style="{ padding: '0px' }" shadow="hover">
            <img
              src="https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png"
              width="100%"
            >
          </el-card>
        </el-col>
      </el-row>
    </el-main>
  </el-container>
</template>


<script>
export default {
  data() {
    return {
      currentDate: new Date(),
      resList: [
        {
          "06": [
            "https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png",
            "https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png",
            "https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png"
            ]
        },
        {
          "07": [
            "https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png",
            "https://shadow.elemecdn.com/app/element/hamburger.9cf7b091-55e9-11e9-a976-7f4d0b07eef6.png"
            ]
        }
      ]
    };
  },
  methods: {
    getUserAlbum() {
      this.$api.getUserAlbum().then(
        res => {
          console.log(res);
          if (res.data.status == 200) {
            this.resList = res.data.datas;
          }
        },
        err => {
          console.log(err);
        }
      );
    }
  },
  created() {
    this.getUserAlbum();
  }
};
</script>

<style>
</style>

