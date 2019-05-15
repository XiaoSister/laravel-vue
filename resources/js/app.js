window.Vue = require('vue');

window.axios = require('axios');

import VueRouter from 'vue-router'

import zh_CN from 'vee-validate/dist/locale/zh_CN';
import VeeValidate, { Validator } from 'vee-validate';

Vue.use(VueRouter);
Vue.use(VeeValidate);
Validator.localize('zh_CN', zh_CN);

import router from './router'

const app = new Vue({
    el: '#app',
    router
});
