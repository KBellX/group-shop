import Vue from 'vue'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false

import Vant from 'vant';
import 'vant/lib/index.css';
Vue.use(Vant);
import './validator/validator.js';
import store from './store/index'
import './permission'

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
