<template>
    <div class="actors">
        <div class="row">
            <div v-if="message" class="alert alert-danger" role="alert" style="width:100%;">{{ message }}</div>
        </div>
        <div class="loading" v-if="loading">Loading...</div>

        <div v-if="error" class="error">
          <p>{{ error }}</p>
          <p><button @click.prevent="fetchData">Try Again</button></p>
        </div>
        
        <div v-if="actors">
            <div>
                <router-link :to="{ name: 'actors.create' }">
                    <button type="button" class="btn btn-primary" :disabled="saving">Add Actor</button>
                </router-link>
                <button type="button" class="btn btn-danger" :disabled="saving" @click.prevent="onDelete()">Delete</button>
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
                                <button type="button" class="btn btn-secondary" :disabled="saving">Edit</button>
                            </router-link>
                            <input type="checkbox" :id="'checkbox-' + actor.id" v-model="actorsToDelete" :value="actor">
                            <label :for="'checkbox-' + actor.id">Delete?</label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
            <router-link :to="{ name: 'actors.create' }">
                <button type="button" class="btn btn-primary" :disabled="saving">Add Actor</button>
                <button type="button" class="btn btn-danger" :disabled="saving" @click.prevent="onDelete()">Delete</button>
            </router-link>
        </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import api from '../js/api/actors';

export default {
    data() {
        return {
            message: null,
            loaded: false,
            saving: false,
            actors: null,
            actorsToDelete: [],
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    watch: {
        actors: function (val) {
            axios
                .get('/api/actors')
                .then(response => {
                  this.actors = response.data.data;
                }).catch(error => {
                  this.error = error.response.data.message || error.message;
                });
        }
    },
    methods: {
        onDelete() {
            this.saving = true;
            this.actorsToDelete.forEach(element => {
               api.delete(element.id)
                .then((response) => {
                    this.actorsToDelete.splice(this.actorsToDelete.indexOf(element), 1);
                    this.message = 'Actor Deleted';
                    setTimeout(() => this.message = null, 2000);
                }).catch(error => {
                    console.log(error);
                }).then(_ => this.saving = false);
            });
        },
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