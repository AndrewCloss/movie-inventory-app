import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../views/App'
import Home from '../views/Home'
import Movies from '../views/Movies'
import Actors from '../views/Actors'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/movies',
            name: 'movies',
            component: Movies,
        },
        {
            path: '/actors',
            name: 'actors',
            component: Actors,
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});