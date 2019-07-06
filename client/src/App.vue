<template>
  <div id="app">
    <div class="app-header">
      <v-header></v-header>
    </div>
    <div class="app-container" style="clear:both;">
      <keep-alive>
        <transition :name="transitionName">
          <router-view></router-view>
        </transition>
      </keep-alive>
    </div>
    <div class="app-footer">
      <v-footer></v-footer>
    </div>
  </div>
</template>

<script>
import VHeader from "./components/header";
import VFooter from "./components/footer";

export default {
  name: "App",
  components: {
    VHeader,
    VFooter
  },
  data() {
    return {
      transitionName: "slide-left"
    };
  },
  watch: {
    $route(to, from) {
      const toDepth = to.path.split("/").length;
      const fromDepth = from.path.split("/").length;
      this.transitionName = toDepth < fromDepth ? "slide-left" : "slide-right";
    }
  }
};
</script>

<style>
.slide-left-enter-active {
  transition: all 0.3s ease;
}
.slide-left-leave-active {
  transition: all 0.6s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-left-enter,
.slide-left-leave-to {
  transform: translateX(-0.3rem);
  opacity: 0;
}

.slide-right-enter-active {
  transition: all 0.3s ease;
}
.slide-right-leave-active {
  transition: all 0.6s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-right-enter,
.slide-right-leave-to {
  transform: translateX(0.3rem);
  opacity: 0;
}
</style>
