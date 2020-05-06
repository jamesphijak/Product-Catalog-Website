import Vue from 'vue'
import App from './App.vue'
import router from './router/DOSCG'
import store from './store'
import VeeValidate from 'vee-validate';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap'
import * as jquery from 'jquery'
global.jquery = jquery

import '@fortawesome/fontawesome-free/css/all.css'
import './assets/styles.css'


Vue.config.productionTip = false
Vue.prototype.jquery = jquery;
Vue.use(VeeValidate);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
