<template>
<div>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="https://github.com/AndrewCloss/movie-inventory-app">Andrew Closs</a>
            
            <router-link class="active text-white" :to="{ name: 'home' }">Home</router-link><span class="text-light"> |</span>
            <router-link class="text-light" :to="{ name: 'movies' }">Movies</router-link><span class="text-light"> |</span>
            <router-link class="text-light" :to="{ name: 'actors' }">Actors</router-link>
        </div>
    </nav>

    <div role="main" class="container">
        <router-view></router-view>
    </div>

     <footer class="pt-2 my-md-3 pt-md-3 border-top">
      <div class="container">
        <span class="text-muted">@ 2020 Super real copyright: andrew.closs@gmail.com</span>
      </div>
    </footer>
</div>
</template>
<script>
    export default {}
</script>