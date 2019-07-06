<template>
  <el-container>
    <div class="weiboTool">
      <ul>
        <li>
          <a href="javasript: void(0)" class="collect iconNum">{{collectNum?collectNum:'收藏'}}</a>
        </li>
        <li>
          <a href="javasript: void(0)" class="forwardNum iconNum">转发</a>
        </li>
        <li>
          <a href="javasript: void(0)" class="talkNum iconNum">评论</a>
        </li>
        <li @click="clickLike">
          <a
            href="javasript: void(0)"
            class="iconNum"
            :class="isLike?'goodNum_click':'goodNum'"
          >{{praisedNum?praisedNum:'赞'}}</a>
        </li>
      </ul>
    </div>
  </el-container>
</template>

<script>
export default {
  data() {
    return {
      praisedNum: 0,
      collectNum: 0,
      isLike: false
    };
  },
  methods: {
    clickLike() {
      this.isLike = !this.isLike;
    }
  }
};
</script>

