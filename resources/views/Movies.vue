<template>
    <div class="movies">
        <div class="row">
            <div v-if="message" class="alert alert-danger" role="alert" style="width:100%;">{{ message }}</div>
        </div>
        <div class="loading" v-if="loading">Loading...</div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>
          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>

        <div v-if="movies">
            <div>
                <router-link :to="{ name: 'movies.create' }">
                    <button type="button" class="btn btn-primary" :disabled="saving">Add Movie</button>
                </router-link>
                <button type="button" class="btn btn-danger" :disabled="saving" @click.prevent="onDelete()">Delete</button>
            </div>

            <div class="row py-2">
                <div
                    class="col-sm-12 col-md-6 col-lg-4 px-1 py-1"
                    v-for="(movie, id) in movies"
                    :key="id"
                >
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ movie.title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ movie.description }}</h6>
                            <p class="card-text"><strong>Release Date:</strong> {{ movie.release_date }}</p>
                            <p class="card-text"><strong>Genre Type:</strong> {{ movie.genre_type }}</p>
                            <router-link :to="`/movies/${movie.id}/edit`">
                                <button type="button" class="btn btn-secondary" :disabled="saving">Edit</button>
                            </router-link>
                            <input type="checkbox" :id="'checkbox-' + movie.id" v-model="moviesToDelete" :value="movie">
                            <label :for="'checkbox-' + movie.id">Delete?</label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <router-link :to="{ name: 'movies.create' }">
                    <button type="button" class="btn btn-primary" :disabled="saving">Add Movie</button>
                <button type="button" class="btn btn-danger" :disabled="saving" @click.prevent="onDelete()">Delete</button>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import api from '../js/api/movies';

export default {
    data() {
        return {
            message: null,
            loaded: false,
            saving: false,
            movies: null,
            moviesToDelete: [],
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    watch: {
        movies: function (val) {
            axios
                .get('/api/movies')
                .then(response => {
                  this.movies = response.data.data;
                }).catch(error => {
                  this.error = error.response.data.message || error.message;
                });
        }
    },
    methods: {
        onDelete() {
            if (this.moviesToDelete.length > 0) {
                this.saving = true;
                this.moviesToDelete.forEach(element => {
                api.delete(element.id)
                    .then((response) => {
                        this.moviesToDelete.splice(this.moviesToDelete.indexOf(element), 1);
                        this.message = 'Movie Deleted';
                        setTimeout(() => this.message = null, 2000);
                    }).catch(error => {
                        console.log(error);
                    }).then(_ => this.saving = false);
                });
            }
        },
        fetchData() {
            this.error = this.movies = null;
            this.loading = true;
            axios
                .get('/api/movies')
                .then(response => {
                  this.loading = false;
                  this.movies = response.data.data;
                }).catch(error => {
                  this.loading = false;
                  this.error = error.response.data.message || error.message;
                });
        }
    }
}
</script>