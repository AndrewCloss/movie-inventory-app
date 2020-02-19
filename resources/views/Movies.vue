<template>
    <div class="movies">
        <div class="loading" v-if="loading">Loading...</div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>
          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>

        <div v-if="movies">
            <div>
                <router-link :to="{ name: 'movies.create' }">
                    <button type="button" class="btn btn-primary">Add Movie</button>
                </router-link>
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
                                <button type="button" class="btn btn-secondary">Edit</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <router-link :to="{ name: 'movies.create' }">
                    <button type="button" class="btn btn-primary">Add Movie</button>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            movies: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
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