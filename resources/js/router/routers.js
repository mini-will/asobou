import VueRouter from 'vue-router';
import TopPage from '../components/pages/TopPage'
import PlayInfo from '../components/pages/PlayInfo.vue'
import PlayAllItem from '../components/pages/PlayAllItem.vue'
import About from '../components/pages/About.vue'

const routes = [{
        path: "/",
        name: "toppage",
        component: TopPage,
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
    {
        path: '/about',
        name: 'about',
        component: About
    },

];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});

export default router;
