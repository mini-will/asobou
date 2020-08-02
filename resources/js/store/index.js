import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        playOld: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 999],
        teppan: false,
        form: {
            activePlayOld: null,
            activeTeppan: false,
        },
        displayPlay: [],
    },
    getters: {
        playOld(state) {
            return state.playOld
        },
        teppan(state) {
            return state.teppan
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
