<template>
<div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="https://github.com/AndrewCloss/movie-inventory-app">Andrew Closs</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <router-link class="nav-link"  :to="{ name: 'home' }">Home</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link"  :to="{ name: 'movies' }">Movies</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link"  :to="{ name: 'actors' }">Actors</router-link>
            </li>
        </ul>
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