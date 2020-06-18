import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        playOld: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        form: {
            activePlayOld: null
        },
        teppan: false,
        displayPlay: [],
    },
    getters: {
        playOld(state) {
            return state.playOld
        }
    },
    mutations: {
        updateValue(state, {
            vals,
            key_name
        }) {
            state.form[key_name] = vals;
        },
    },
    actions: {}
});
