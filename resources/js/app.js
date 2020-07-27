require('./bootstrap');

import VueRouter from 'vue-router';
import router from './router/routers';
import store from './store';
import Index from './Index';

import vuetify from '../../src/plugins/vuetify';
import Vuetify from 'vuetify';
import "vuetify/dist/vuetify.min.css";
import colors from 'vuetify/es5/util/colors';

window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(Vuetify, {
    themes: {
        light: {
            primary: colors.purple,
            secondary: colors.grey.darken1,
            accent: colors.shades.black,
            error: colors.red.accent3,
        },
        dark: {
            primary: colors.red.lighten3,
        },
    },
});

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
