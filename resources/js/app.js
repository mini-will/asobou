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

// eslint-disable-next-line no-undef
Vue.use(VueRouter);
// eslint-disable-next-line no-undef
Vue.use(Vuetify, {
    theme: {
        dark: true,
        themes: {
            light: {
                primary: colors.green.darken4,
                accent: colors.grey.darken3,
                secondary: colors.amber.darken3,
                info: colors.teal.lighten1,
                warning: colors.amber.base,
                error: colors.deepOrange.accent4,
                success: colors.green.accent3
            },
            dark: {
                primary: colors.green.darken2,
                accent: colors.grey.darken3,
                secondary: colors.amber.darken3,
                info: colors.teal.lighten1,
                warning: colors.amber.base,
                error: colors.deepOrange.accent4,
                success: colors.green.accent3
            },
        },
    }
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
