import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // トップページで遊び年齢を保持するデータ
        playOldState: 999,

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
            // 渡ってきたpayloadの中身が配列かどうかで処理を分ける
            // 配列形式じゃないとうまくデータを取り出せないケースがあったので
            if (Array.isArray(payload.response.data)) {
                // console.log("array");
                for (let k of Object.keys(payload.response.data)) {
                    state.displayPlayItemState.splice(payload.index, 1, payload.response.data[k]);
                }
            } else {
                // console.log("not array");
                state.displayPlayItemState.splice(payload.index, 1, payload.response.data);
            }
        }

    },
    actions: {}
});
