<template>
    <div>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="!loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
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
                <button type="submit" :disabled="saving">Update</button>
                <button :disabled="saving" @click.prevent="onDelete($event)">Delete</button>
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
            this.message = 'Movie Deleted';
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
            this.message = 'Movie updated';
                setTimeout(() => this.$router.push({ name: 'movies' }), 2000);
            this.movie = response.data.data;
        }).catch(error => {
            console.log(error)
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