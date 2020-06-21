import VueRouter from 'vue-router';
import TopPage from './Pages/TopPage'
import PlayInfo from './Pages/PlayInfo.vue'
import PlayAllItem from './Pages/PlayAllItem.vue'
import About from './Pages/About.vue'


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
