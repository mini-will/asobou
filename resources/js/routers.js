import VueRouter from 'vue-router';
import TopPage from './components/TopPage'
import PlayIndex from './components/PlayIndex'

const routes = [{
        path: "/",
        component: TopPage,
        name: "home"
    },
    {
        path: "/playindex",
        component: PlayIndex,
        name: "playindex"
    }
];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});

export default router;
