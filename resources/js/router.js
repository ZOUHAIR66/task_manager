import {createRouter ,createWebHistory} from 'vue-router';
import Home from './pages/Home.vue';
import Dashboard from './pages/Dashboard.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import { UserStore } from './store/UserStore';

const routes = [
    {
        path:'/',
        name:'Home',
        component:Home
    },
    {
        path:'/dashboard',
        name:'Dashboard',
        component:Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:'/login',
        name:'Login',
        component:Login,
        meta: {
            requiresAuth: false
        }
    },
    {
        path:'/register',
        name:'Register',
        component:Register,
        meta: {
            requiresAuth: false
        }
    },

];

const router = createRouter({
    history:createWebHistory(),
    routes
});

router.beforeEach((to, from) => {

    const store = UserStore();

    if (to.meta.requiresAuth && store.token == 0) {
        return { name: 'Login' }
    }
    if (to.meta.requiresAuth == false && store.token != 0) {
        return { name: 'Dashboard' }
    }
});

export default router;