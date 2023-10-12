import './bootstrap';
import '../css/app.css';
import "tw-elements";
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { createPinia } from 'pinia';
import App from './App.vue';

import router from './router.js'


const pinia = createPinia();

const app = createApp({
    components: {
        App,
    }
});
app.use(pinia)
app.use(router)
app.mount('#app');
