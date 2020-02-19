<template>
    <div>
        <h1>Create an Actor</h1>
        <div class="row">
            <div v-if="message" class="alert alert-danger" role="alert" style="width:100%;">{{ message }}</div>
        </div>
        <form @submit.prevent="onSubmit($event)" class="jumbotron">
            <div class="row">
                <div class="form-group col-sm-12">
                    <div class="form-group">
                        <label for="actor_name">Name</label>
                        <input id="actor_name" v-model="actor.name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <router-link :to="{ name: 'actors' }"><button type="button" class="btn btn-secondary">Back</button></router-link>
                <button type="submit" class="btn btn-primary" :disabled="saving">
                    {{ saving ? 'Creating...' : 'Create' }}
                </button>
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
            saving: false,
            actor: {
                id: null,
                name: ""
            }
        };
    },
    methods: {
        onSubmit($event) {
        this.saving = true
        this.message = false
        api.create(this.actor)
        .then((response) => {
            this.message = 'Actor created. You will be redirected to the edit page.';
            setTimeout(() => this.$router.push({ name: 'actors.edit', params: { id: response.data.data.id } }), 2000);
        })
        .catch((e) => {
            this.message = e.response.data.message || 'There was an issue creating the actor.';
        })
        .then(() => this.saving = false)
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