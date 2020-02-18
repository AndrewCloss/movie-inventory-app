import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../views/App'
import Home from '../views/Home'
import Movies from '../views/Movies'
import Actors from '../views/Actors'
import MoviesEdit from '../views/MoviesEdit'
import ActorsEdit from '../views/ActorsEdit'
import MoviesCreate from '../views/MoviesCreate'
import ActorsCreate from '../views/ActorsCreate'
import PageNotFound from '../views/PageNotFound'

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
            path: '/movies/create',
            name: 'movies.create',
            component: MoviesCreate
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
        },
        {
            path: '/actors/create',
            name: 'actors.create',
            component: ActorsCreate
        },
        { 
            path: '/404', 
            name: '404', 
            component: PageNotFound 
        },
        { 
            path: '*', 
            redirect: '/404' 
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});