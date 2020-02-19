<template>
    <div>
        <h1>Create a Movie</h1>
        <div class="row">
            <div v-if="message" class="alert alert-danger" role="alert" style="width:100%;">{{ message }}</div>
        </div>
        <form @submit.prevent="onSubmit($event)" class="jumbotron">
            <div class="row">
                <div class="form-group col-sm-9">
                    <label for="movie_title">Title</label>
                    <textarea style="width:100%; height:3em;" id="movie_title" v-model="movie.title"></textarea>
                </div>
                <div class="form-group col-sm-3">
                    <label for="movie_release_date">Release Date</label>
                    <input style="width:100%; height:2em;" id="movie_release_date" v-model="movie.release_date" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-9 form-group">
                    <label for="movie_description">Description</label>
                    <textarea style="width:100%; height:6em;" id="movie_description" v-model="movie.description"></textarea>
                </div>
                
                <div class="form-group col-sm-3 form-group">
                    <label for="movie_genre_type">Genre Type</label>
                    <select style="width:100%; height:2em;" v-model="movie.genre_type">
                        <option disabled value="">Please select one</option>
                        <option value="horror">Horror</option>
                        <option value="comedy">Comedy</option>
                        <option value="scifi">Sci-fi</option>
                        <option value="romance">Romance</option>
                        <option value="action">Action</option>
                        <option value="drama">Drama</option>
                        <option value="documentary">Documentary</option>
                        <option value="crime">Crime</option>
                        <option value="fantasy">Fantasy</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <router-link :to="{ name: 'movies' }"><button type="button" class="btn btn-secondary">Back</button></router-link>
                <button type="submit" class="btn btn-primary" :disabled="saving">
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
            this.message = 'Movie created. You be redirected to the edit page.';
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