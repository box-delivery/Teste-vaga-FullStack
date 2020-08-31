<template>
  <div id="app">
    <router-view name="header"></router-view>
    <main>
      <fade-transition origin="center" mode="out-in" :duration="250">
        <router-view />
      </fade-transition>
    </main>
    <router-view name="footer"></router-view>
  </div>
</template>
<script>
import { FadeTransition } from "vue2-transitions";
import Header from "./layout/starter/StarterHeader";
import Footer from "./layout/starter/StarterFooter";

export default {
  name: 'app',

  components: {
    FadeTransition,
    Header,
    Footer
  },
};
</script>
