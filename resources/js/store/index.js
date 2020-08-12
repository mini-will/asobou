import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // トップページで遊び年齢を保持するデータ
        playOldState: [0],

        // トップページで表示された遊びデータ
        displayPlayItemState: [],
    },
    getters: {
        playOld(state) {
            return state.playOld
        },
    },
    mutations: {
        setOld(state, payload) {
            state.playOldState = payload.playOld
        },
        setDisplayPlayItem(state, payload) {
            for (let k of Object.keys(payload.response.data)) {
                state.displayPlayItemState.push(payload.response.data[k]);
            }
        },
        spliceDisplayPlayItem(state, payload) {
            state.displayPlayItemState.splice(payload.index, 1, payload.response.data);
            console.log("spliceDisplayPlayItem:index " + payload.index + "response category" + payload.response.data.category);
        }

    },
    actions: {}
});
