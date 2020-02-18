<template>
    <div class="movies">
        <div class="loading" v-if="loading">Loading...</div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>
          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>

        <ul v-if="movies">
            <li 
              v-for="(movie, id) in movies"
              :key="id"
            >
                <strong>Title:</strong> {{ movie.title }},
                <strong>Release Date:</strong> {{ movie.release_date }},
                <strong>Description:</strong> {{ movie.description }},
                <strong>Genre Type:</strong> {{ movie.genre_type }} |
                <router-link :to="`/movies/${movie.id}/edit`">Edit</router-link>
            </li>
        </ul>

        <div>
            <router-link :to="{ name: 'movies.create' }">Add Movie</router-link>
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