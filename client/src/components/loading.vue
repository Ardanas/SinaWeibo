<template>
  <el-row style="width: 100%">
    <el-col :span="24">
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
    </el-col>
  </el-row>
</template>

<script>
export default {
  props: {
    isLoading: {
      type: Boolean,
      default: true
    }
  }
};
</script>

