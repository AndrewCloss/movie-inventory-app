<template>
    <div class="actors">
        <div class="loading" v-if="loading">Loading...</div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>
          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>
        
        <div v-if="actors">
            <div>
                <router-link :to="{ name: 'actors.create' }">
                    <button type="button" class="btn btn-primary">Add Actor</button>
                </router-link>
            </div>

            <div class="row py-2">
                <div
                    class="col-sm-6 col-md-3 px-1 py-1"
                    v-for="(actor, id) in actors"
                    :key="id"
                >
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ actor.name }}</h5>
                            <router-link :to="`/actors/${actor.id}/edit`">
                                <button type="button" class="btn btn-secondary">Edit</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <div>
            <router-link :to="{ name: 'actors.create' }">
                <button type="button" class="btn btn-primary">Add Actor</button>
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