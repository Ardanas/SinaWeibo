<template>
  <el-container>
    <el-row style="width: 100%;">
      <el-col :span="24">
        <div class="pictext_i pictext_i_v5">
          <div class="m_wrap">
            <!-- feed内容 -->
            <div class="UG_contents">
              <!--feed内容-->
              <ul class="pt_ul clearfix" pagenum node-type="feed_list">
                <!--article feed-->
                <div
                  class="UG_list_b"
                  href="#"
                  v-for="(item, index) in resList"
                  :key="index"
                  @click="toDetail(item.postid?item.postid:item.docid)"
                >
                  <div class="pic W_piccut_v">
                    <img :src="item.imgsrc" :alt="item.title">
                  </div>
                  <div class="list_des">
                    <h3 class="list_title_b">
                      <a href="#" class="S_txt1 W_f20">{{item.title}}</a>
                    </h3>
                    <div class="subinfo_box clearfix">
                      <a href="#">
                        <span class="subinfo_face">
                          <img
                            :src="item.imgsrc"
                            width="20"
                            height="20"
                            :alt="item.source"
                            class="source_cover"
                          >
                        </span>
                      </a>
                      <a href="#">
                        <span class="subinfo S_txt2">{{item.source}}</span>
                      </a>
                      <span class="subinfo S_txt2">{{item.ptime.split(" ")[0]}}&ensp;{{item.ptime.split(" ")[1]}}</span>
                      <div style="float: right; margin: 5px 30px 0 0;">
                        <span class="S_txt2" >
                          <i class="el-icon-comment" ></i>
                          <span class="w_f12">{{item.replyCount?item.replyCount:item.commentCount}}</span>
                         
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </ul>
              <!--/feed内容-->
            </div>

            <div class="wb_cardwrap s_bg2" v-show="isLoading">
              <div class="wb_empty">
                <div class="wb_innerwrap">
                  <p class="text">
                    <span class="el-icon-loading"></span>
                    正在加载中，请稍候...
                  </p>
                </div>
              </div>
            </div>
            <!-- /feed内容 -->
          </div>
        </div>
      </el-col>
    </el-row>
  </el-container>
</template>


<script>
export default {
  props: {
    resList: {
      default: {}
    },
    isLoading: {
      type: Boolean,
      default: true
    },
    tid: {
      type: String,
      default: "1"
    }
  },
  methods: {
    toDetail(pid) {
      let id = this.tid;
      this.$router.push({ path: `/tag/${id}/detail/${pid}` });
    }
  }
};
</script>

