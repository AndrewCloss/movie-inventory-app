<template>
    <div>
        <h1>Edit a Movie</h1>
        <div class="row">
            <div v-if="message" class="alert alert-danger" role="alert" style="width:100%;">{{ message }}</div>
        </div>
        <div v-if="!loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else class="jumbotron">
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
                        <option value="Horror">Horror</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Sci-fi">Sci-fi</option>
                        <option value="Romance">Romance</option>
                        <option value="Action">Action</option>
                        <option value="Drama">Drama</option>
                        <option value="Documentary">Documentary</option>
                        <option value="Crime">Crime</option>
                        <option value="Fantasy">Fantasy</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <router-link :to="{ name: 'movies' }"><button type="button" class="btn btn-secondary">Back</button></router-link>
                <button type="submit" class="btn btn-primary" :disabled="saving">Update</button>
                <button type="button" class="btn btn-danger" :disabled="saving" @click.prevent="onDelete($event)">Delete</button>
            </div>
        </form>
    </div>
</template>
<script>
import api from '../js/api/movies';

export default {
    data() {
        return {
            message: null,
            loaded: false,
            saving: false,
            movie: {
                id: null,
                title: "",
                release_date: "",
                description: "",
                genre_type: ""
            }
        };
    },
  methods: {
    onDelete() {
        this.saving = true;
        api.delete(this.movie.id)
        .then((response) => {
            this.message = 'Movie deleted. You will be redirected back to the index';
            setTimeout(() => this.$router.push({ name: 'movies' }), 2000);
        }).catch(error => {
            console.log(error)
        }).then(_ => this.saving = false);
    },
    onSubmit(event) {
        this.saving = true;

        api.update(this.movie.id, {
            title: this.movie.title,
            release_date: this.movie.release_date,
            description: this.movie.description,
            genre_type: this.movie.genre_type
        }).then((response) => {
            this.message = 'Movie updated. You will be redirected back to the index.';
                setTimeout(() => this.$router.push({ name: 'movies' }), 2000);
            this.movie = response.data.data;
        }).catch(error => {
            this.message = 'There was an issue creating the movie, check your inputs.';
        }).then(_ => this.saving = false);
    }
  },
    created() {
        api.find(this.$route.params.id)
        .then((response) => {
            this.loaded = true;
            this.movie = response.data.data;
        })
        .catch((err) => {
            this.$router.push({ name: '404' });
        });
    }
};
</script>
<style lang="scss" scoped>
$red: lighten(red, 30%);
$darkRed: darken($red, 50%);
.form-group label {
  display: block;
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