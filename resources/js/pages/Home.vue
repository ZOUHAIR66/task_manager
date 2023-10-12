<template>
    <div>
        <Hero />
    </div>
</template>

<script>
import Hero from '../layouts/Hero.vue';
import { mapState } from 'pinia';
import { UserStore } from '../store/UserStore';


export default {
    name: 'Home',
    components: { Hero },
    
}
</script>