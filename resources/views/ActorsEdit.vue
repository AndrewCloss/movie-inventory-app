<template>
    <div>
        <div v-if="message" class="alert alert-danger" role="alert">{{ message }}</div>
        <div v-if="!loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else class="jumbotron">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="form-group">
                        <label for="actor_name">Name</label>
                        <input style="height:2em;" id="actor_name" v-model="actor.name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <router-link :to="{ name: 'actors' }"><button type="button" class="btn btn-secondary">Back</button></router-link>
                <button type="submit" class="btn btn-primary" :disabled="saving">Update</button>
                <button type="button" class="btn btn-danger" :disabled="saving" @click.prevent="onDelete($event)">Delete</button>
            </div>
        </form>
    </div>
</template>
<script>
import api from '../js/api/actors';

export default {
    data() {
        return {
            message: null,
            loaded: false,
            saving: false,
            actor: {
                id: null,
                name: ""
            }
        };
    },
    methods: {
        onDelete() {
            this.saving = true;
            api.delete(this.actor.id)
            .then((response) => {
                this.message = 'Actor Deleted';
                setTimeout(() => this.$router.push({ name: 'actors' }), 2000);
            }).catch(error => {
                console.log(error)
            }).then(_ => this.saving = false);
        },
        onSubmit(event) {
            this.saving = true;

            api.update(this.actor.id, {
                name: this.actor.name
            }).then((response) => {
                this.message = 'Actor updated';
                setTimeout(() => this.$router.push({ name: 'actors' }), 2000);
                this.actor = response.data.data;
            }).catch(error => {
                console.log(error)
            }).then(_ => this.saving = false);
        },
        onDelete() {
            this.saving = true;

            api.delete(this.actor.id)
                .then((response) => {
                    this.message = 'User Deleted';
                    setTimeout(() => this.$router.push({ name: 'actors' }), 2000)
                });
        }
    },
    created() {
        api.find(this.$route.params.id).then((response) => {
            this.loaded = true;
            this.actor = response.data.data;
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