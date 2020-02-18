<template>
    <div class="movies">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>

          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>

        <ul v-if="movies">
            <li 
              v-for="{ title, release_date, description, genre_type, id } in movies"
              :key="id"
            >
                <strong>Title:</strong> {{ title }},
                <strong>Release Date:</strong> {{ release_date }},
                <strong>Description:</strong> {{ description }},
                <strong>Genre Type:</strong> {{ genre_type }}
            </li>
        </ul>
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
                  this.movies = response.data;
                }).catch(error => {
                  this.loading = false;
                  this.error = error.response.data.message || error.message;
                });
        }
    }
}
</script>