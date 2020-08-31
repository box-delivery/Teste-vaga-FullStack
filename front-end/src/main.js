import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import { sync } from "vuex-router-sync";
import Argon from "./plugins/argon-kit";
import VueSweetalert2 from 'vue-sweetalert2'
import Response from './services/Response';
import VueResource from 'vue-resource';
import 'jquery/dist/jquery.min.js';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-multiselect/dist/vue-multiselect.min.css';

sync(store, router);

Vue.config.productionTip = false;
Vue.use(Argon);
Vue.use(VueSweetalert2)
Vue.use(Response)
Vue.use(VueResource);
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
