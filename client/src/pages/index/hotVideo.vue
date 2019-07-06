<template>
  <el-container>
    <el-row>
      <el-col :span="24" >
        <v-video v-for="(o, index) in 5" :key="index"></v-video>
      </el-col>
    </el-row>
  </el-container>
</template>



