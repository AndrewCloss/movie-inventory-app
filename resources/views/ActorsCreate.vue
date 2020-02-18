<template>
    <div>
        <h1>Create an Actor</h1>
        <div v-if="message" class="alert">{{ message }}</div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="actor_name">Name</label>
                <input id="actor_name" v-model="actor.name" />
            </div>

            <div class="form-group">
                <button><router-link :to="{ name: 'actors' }">Back</router-link></button>
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
            this.message = 'Actor Created';
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