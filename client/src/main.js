// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import router from './router/index'
import App from './App'
import store from './vuex'
import { Message } from 'element-ui'

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import './assets/css/common.css'
import './assets/login/css/weibo.css'
import './assets/home/css/lmlblog.css'
import './assets/home/css/all.css'

import { api } from './utils/api'
import utils from './utils/util'
//引入全局组件
import bottom_bar from '../src/components/bottom_bar'
import pic_1 from '../src/components/pic_1'
import pic_4 from '../src/components/pic_4'
import pic_9 from '../src/components/pic_9'
import video_comp from '../src/components/video_comp'
import word_comp from '../src/components/word_comp'

import { emoji } from '../src/assets/index/js/emoji'


Vue.prototype.$HOST = 'http://192.168.80.1/controller/'
Vue.prototype.$api = api;
Vue.prototype.$utils = utils;
Vue.prototype.$emoji = emoji
Vue.config.productionTip = false;


Vue.use(ElementUI);
Vue.component(ElementUI.Message.name, ElementUI.Message)
Vue.prototype.$message = ElementUI.Message;
//声明全局组件
Vue.component('VBottomBar', bottom_bar)
Vue.component('VP1', pic_1)
Vue.component('VP4', pic_4)
Vue.component('VP9', pic_9)
Vue.component('VVideo', video_comp)
Vue.component('VWord', word_comp)

router.beforeEach((to, from, next) => {

  let user = JSON.parse(sessionStorage.getItem('userInfo'));

  console.log(!user && typeof (user) != 'undefined' && user != 0);
  if (!user && typeof (user) != 'undefined' && user != 0) { //为null
    //console.log("xxxuser")
    //console.log(to.path.indexOf("/index") == -1)
    let toIndex = to.path.indexOf("/index"); 
    let toHome = to.path.indexOf("/home");
    console.log(toIndex)
    console.log(toHome)
    if (toIndex == -1 && toHome == -1) {
      next();
    } else {
      next('/tag1');
    }
  }else{
    if(to.path === '/tag1'){
      next('/index')
    }else{
      next();
    }
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
