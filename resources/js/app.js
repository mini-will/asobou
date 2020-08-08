require('./bootstrap');

import VueRouter from 'vue-router';
import router from './router/routers';
import store from './store';
import Index from './Index';

import vuetify from '../../src/plugins/vuetify';
import Vuetify from 'vuetify';
import "vuetify/dist/vuetify.min.css";

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify);


// eslint-disable-next-line no-unused-vars
const app = new Vue({
    el: '#app',
    router,
    vuetify,
    store,
    components: {
        "index": Index
    }
});
