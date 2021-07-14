
require('./bootstrap');

window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'


Vue.component('App', require('./components/App.vue').default);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from "./store/index"

Vue.use(BootstrapVue)

Vue.use(IconsPlugin)

const app = new Vue({
    el: '#app',
    store
});
