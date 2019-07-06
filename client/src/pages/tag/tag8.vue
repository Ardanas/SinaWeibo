<template>
  <div id="plc_home_main">
    <v-data-list :resList="resList" :isLoading="isLoading" :tid="id"></v-data-list>
  </div>
</template>


<script>
import VDataList from "../../components/datalist";
export default {
  props: ["id"],
  data() {
    return {
      resList: {},
      isLoading: true
    };
  },
  components: {
    VDataList
  },
  methods: {
  },
  mounted() {
    this.$api
      .getTagOneList({
        type: 4,
        page: 5
      })
      .then(
        res => {
          console.log(res);
          if (res.code === 1) {
            this.isLoading = false;
            this.resList = res.data;
          }
        },
        err => {
          console.log(err);
        }
      );
  }
};
</script>
