<template>
  <el-container>
    <el-row style="width: 100%;padding: 10px;">
      <el-col :span="24">
        <h1 class="Font Mar_b_10 D_title">{{resList.title}}</h1>
      </el-col>
      <el-col :span="24">
        <div href="#">
          <span
            class="subinfo S_txt3"
            style="display: inline_block; margin-right: 15px;"
          >{{pdate}}&ensp;{{ptime}}</span>
          <span class="subinfo S_txt3">来源：{{resList.source}}</span>
        </div>
      </el-col>
      <el-col :span="24">
        <div class="D_body" v-html="resList.body"></div>
      </el-col>
      <el-col :span="24">
        <div href="#" class="w_fr">
          <span
            class="subinfo S_txt3"
            style="display: inline_block; margin-right: 30px;"
          >本文来源：{{resList.source}}</span>
          <span class="subinfo S_txt3">责任编辑：{{resList.ec?resList.ec:'不详'}}</span>
        </div>
      </el-col>
    </el-row>
  </el-container>
</template>

<script>
export default {
  props: ["postid"],
  data() {
    return {
      resList: {},
      pdate: '',
      ptime: ''
    };
  },
  methods: {
    getPicTemplate(src, alt, width, height) {
      const template = `
            <p class='f_center'>
                <img src='${src}' alt='${alt}' width='${width}' height='${height}'/>
            </p>`;
      return template;
    },
    getMsgList() {
      const postid = this.postid;
      //this.$Loading.start()
      this.$api.getTag1Detail(postid).then(
        res => {
          if (res.code === 1) {
            const items = res.data;
            console.log(items.ptime)
            const date = items.ptime.split(" ");
            this.pdate = date[0];
            this.ptime = date[1];
            for(let item of items.img){
                const pixel = item.pixel.split("*");
                const temp = this.getPicTemplate(item.src, item.alt, pixel[0], pixel[1])
                items.body = items.body.replace(item.ref, temp);
            }
            this.resList = items;
            //this.$Loading.start()
          }
        },
        err => {
          console.log(err);
        }
      );
    }
  },
  mounted() {
    this.getMsgList();
  },
  watch: {
    $route: "getMsgList"
  }
};
</script>

