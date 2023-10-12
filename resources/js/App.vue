<template>
    <Navbar />
    
    <router-view></router-view>
</template>

<script>
import Navbar from './layouts/Navbar.vue';
import Home from './pages/Home.vue'
export default {

    name: 'App',
    components: {
        Navbar,
        Home,
        
    }

}
</script>
