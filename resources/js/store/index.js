import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        message: ["一人", "二人以上", "test"],
        todos: [{
                id: 1,
                text: '...',
                done: true
            },
            {
                id: 2,
                text: '...',
                done: false
            }
        ],

    },
    getters: {
        message(state) {
            return state.message
        }
    },
    mutators: {},
    actions: {}
});
