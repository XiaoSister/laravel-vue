window.Vue = require('vue');

window.axios = require('axios');

import VueRouter from 'vue-router'

Vue.use(VueRouter);

import router from './router'

const app = new Vue({
    el: '#app',
    router
});
