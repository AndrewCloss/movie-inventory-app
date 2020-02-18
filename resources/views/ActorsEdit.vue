<template>
    <div>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="!loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <label for="actor_name">Name</label>
                <input id="actor_name" v-model="actor.name" />
            </div>

            <div class="form-group">
                <button><router-link :to="{ name: 'actors' }">Back</router-link></button>
            </div>

            <div class="form-group">
                <button type="submit" :disabled="saving">Update</button>
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
        }
    },
    created() {
        api.find(this.$route.params.id).then((response) => {
            this.loaded = true;
            this.actor = response.data.data;
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