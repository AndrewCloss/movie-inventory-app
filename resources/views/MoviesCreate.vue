<template>
    <div>
        <h1>Create a Movie</h1>
        <div v-if="message" class="alert">{{ message }}</div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="movie_title">Title</label>
                <input id="movie_title" v-model="movie.title" />
            </div>
            <div class="form-group">
                <label for="movie_release_date">Release Date</label>
                <input id="movie_release_date" v-model="movie.release_date" />
            </div>
            <div class="form-group">
                <label for="movie_description">Description</label>
                <input id="movie_description" v-model="movie.description" />
            </div>
            
            <div class="form-group">            
                <label for="movie_genre_type">Genre Type</label>
                <select v-model="movie.genre_type">
                    <option disabled value="">Please select one</option>
                    <option value="horror">Horror</option>
                    <option value="comedy">Comedy</option>
                    <option value="scifi">Sci-fi</option>
                    <option value="romance">Romance</option>
                    <option value="action">Action</option>
                    <option value="drama">Drama</option>
                    <option value="documentary">Documentary</option>
                    <option value="crime">Crime</option>
                </select>
            </div>

            <div class="form-group">
                <button><router-link :to="{ name: 'movies' }">Back</router-link></button>
            </div>

            <div class="form-group">
              <button type="submit" :disabled="saving">
                  {{ saving ? 'Creating...' : 'Create' }}
              </button>
            </div>
        </form>
    </div>
</template>
<script>
import api from '../js/api/movies';

export default {
    data() {
        return {
            message: false,
            saving: false,
            movie: {
                title: "",
                release_date: "",
                description: "",
                genre_type: ""
            }
        };
    },
  methods: {
    onSubmit($event) {
        this.saving = true
        this.message = false
        api.create(this.movie)
        .then((response) => {
            this.message = 'Movie Created';
            setTimeout(() => this.$router.push({ name: 'movies.edit', params: { id: response.data.data.id } }), 2000);
        })
        .catch((e) => {
            this.message = e.response.data.message || 'There was an issue creating the movie.';
        })
        .then(() => this.saving = false);
    }
  }
};
</script>
<style lang="scss" scoped>
$red: lighten(red, 30%);
$darkRed: darken($red, 50%);

.form-group {
    margin-bottom: 1em;
    label {
        display: block;
    }
}
.alert {
    background: $red;
    color: $darkRed;
    padding: 1rem;
    margin-bottom: 1rem;
    width: 50%;
    border: 1px solid $darkRed;
    border-radius: 5px;
}
</style>