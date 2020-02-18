<template>
    <div class="actors">
        <div class="loading" v-if="loading">Loading...</div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>
          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>

        <ul v-if="actors">
            <li 
              v-for="(actor, id) in actors"
              :key="id"
            >
                <strong>Name:</strong> {{ actor.name }} |
                <router-link :to="`/actors/${actor.id}/edit`">Edit</router-link>
            </li>
        </ul>

        <div>
            <router-link :to="{ name: 'actors.create' }">Add Actor</router-link>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            actors: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.actors = null;
            this.loading = true;
            axios
                .get('/api/actors')
                .then(response => {
                  this.loading = false;
                  this.actors = response.data.data;
                }).catch(error => {
                  this.loading = false;
                  this.error = error.response.data.message || error.message;
                });
        }
    }
}
</script>