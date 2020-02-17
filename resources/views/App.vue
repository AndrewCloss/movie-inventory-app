<template>
    <div>
        <h1>Andrew Closs' Movie Inventory Application</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'movies' }">Movies</router-link> |
            <router-link :to="{ name: 'actors' }">Actors</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>