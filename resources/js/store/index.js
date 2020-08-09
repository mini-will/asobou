import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        playOldState: [0],
        displayPlay: [],
    },
    getters: {
        playOld(state) {
            return state.playOld
        },
    },
    mutations: {
        setOld(state, payload) {
            state.playOldState = payload.playOld
        }
    },
    actions: {}
});
