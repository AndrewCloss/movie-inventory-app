import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../views/App'
import Home from '../views/Home'
import Movies from '../views/Movies'
import Actors from '../views/Actors'
import MoviesEdit from '../views/MoviesEdit'
import ActorsEdit from '../views/ActorsEdit'

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
            path: '/movies/:id/edit',
            name: 'movies.edit',
            component: MoviesEdit,
        },
        {
            path: '/actors',
            name: 'actors',
            component: Actors,
        },
        {
            path: '/actors/:id/edit',
            name: 'actors.edit',
            component: ActorsEdit,
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});