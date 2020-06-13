import VueRouter from 'vue-router';
import TopPage from './Pages/TopPage'
import PlayIndex from './Pages/PlayIndex'
import PlayInfo from './Pages/PlayInfo.vue'
import PlayAllItem from './Pages/PlayAllItem.vue'


const routes = [{
        path: "/",
        name: "home",
        component: TopPage,
    },
    {
        path: "/playindex",
        name: "playindex",
        component: PlayIndex,
    },
    {
        path: '/playinfo/:id',
        name: 'PlayInfo',
        component: PlayInfo
    },
    {
        path: '/playallitem',
        name: 'PlayAllItem',
        component: PlayAllItem
    },

];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});

export default router;
