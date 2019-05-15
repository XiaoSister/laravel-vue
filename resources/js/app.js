window.Vue = require('vue');

window.axios = require('axios');

import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate'

Vue.use(VueRouter);
Vue.use(VeeValidate);

import router from './router'

const app = new Vue({
    el: '#app',
    router
});
