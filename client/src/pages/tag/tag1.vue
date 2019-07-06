<template>
  <div id="plc_home_main" style="margin-bottom: 30px;">
    <div class="fream_c">
      <div id="pl_home_feed">
        <!-- 榜单位	置 -->
        <div class="pictext_i pictext_i_v5">
          <div class="m_wrap">
            <!-- /feed内容 -->
            <el-carousel :interval="4000" type="card" height="200px">
              <el-carousel-item v-for="(item,index) in carouselList" :key="index" >
                <img :src="item.imgsrc" :alt="item.title" @click="toDetail(item.postid)">
               
              </el-carousel-item>
            </el-carousel>
            <!-- feed内容 -->
            <div class="UG_contents">
              <!--feed内容-->
              <ul class="pt_ul clearfix">
                <!--article feed-->
                <div
                  class="UG_list_b"
                  href="#"
                  v-for="(item, index) in resList"
                  :key="index"
                  @click="toDetail(item.postid)"
                >
                  <div class="pic W_piccut_v">
                    <img :src="item.imgsrc" :alt="item.title">
                  </div>
                  <div class="list_des">
                    <h3 class="list_title_b">
                      <a href="#" class="S_txt1 W_f20">{{item.ltitle}}</a>
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
                      <span class="subinfo S_txt2">{{item.lmodify}}</span>
                      <div style="float: right; margin: 5px 30px 0 0;font-size: 12px;">
                        <span class="S_txt2">
                          <i class="el-icon-comment"></i>
                          <span>{{item.replyCount?item.replyCount:0}}</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </ul>
              <!--/feed内容-->
            </div>

            <!-- loading内容 -->

            <!-- 加载更多内容 -->
            <div
              class="wb_cardwrap s_bg2"
              v-show="!isLoading"
              @click="getDataList"
              style="cursor:pointer;"
            >
              <div class="wb_empty">
                <div class="wb_innerwrap">
                  <p class="text">
                    <span class="el-icon-caret-bottom"></span>
                    点击加载更多...
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import VLoading from "../../components/loading";
export default {
  data() {
    return {
      resList: [],
      isLoading: true,
      listIndex: 0,
      carouselList: []
    };
  },
  components: {
    VLoading
  },
  methods: {
    toDetail(pid) {
      this.$router.push({ path: `/tag/1/detail/${pid}` });
    },
    getDataList() {
      console.log(this.listIndex);
      let page = this.listIndex * 5 + 5;
      console.log(page);
      this.$api
        .getTagOneList({
          type: 0,
          page: page
        })
        .then(
          res => {
            if (res.code === 1) {
              this.isLoading = false;
              let items = res.data;
              if (this.listIndex == 0) {
                this.resList = items;
              } else {
                //this.resList = this.repeatData(this.resList, items);
                this.resList = [...this.resList, ...items];
              }
              this.carouselList = this.resList.splice(0, 4);
              console.log(this.resList);
              this.listIndex++;
            }
          },
          err => {
            console.log(err);
          }
        );
    },
    repeatData(arr1, arr2) {
      let res = [];
      for (let i = 0; i < arr1.length; i++) {
        for (let j = 0; j < arr2.length; j++) {
          if (arr1[i].postid !== arr2[j].postid) {
            //let arr = new Array(arr2[j])
            res = arr1.push(arr2[j]);
          } else {
            break;
          }
        }
      }
      console.log(res);
      return res;
    }
  },
  mounted() {
    this.getDataList();
  }
};
</script>
