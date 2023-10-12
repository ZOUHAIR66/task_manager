<template>
    <div>
        
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl text-center mt-10">
            Login</h1>



        <div class="items-center flex items-center justify-center mt-10">
            <form @submit.prevent="login" class="bg-slate-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div v-for="erro in error" :key="erro">
                    <p class="text-red-500 text-xs italic" v-for="err in erro" :key="err">{{ err }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Email
                    </label>
                    <input v-model="form.email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" name="name" type="text" placeholder="Name">
                    <p class="text-red-500 text-xs italic" ></p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input v-model="form.password"
                        class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" name="password" type="password" placeholder="******************">
                    <p class="text-red-500 text-xs italic" ></p>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Sign In
                    </button>

                </div>
            </form>

        </div>
    </div>
</template>

<script>
import { ref, reactive } from "vue";
import { useRouter } from 'vue-router';
import { UserStore } from '../store/UserStore.js'

export default {
    name: 'Login',
    setup() {

        let alertOpen= ref(true);
        const router = useRouter();
        const store = UserStore();

        let form = reactive({
            email: '',
            password: ''
        });
       

        const closeAlert = ()=>{ alertOpen.value = false;}


        let error = ref('');
        let message = ref('');
       

        const login = async () => {
            try {
                const response = await axios.post('api/login', form);

                if (response.data.success) {
                    
                    store.setToken(response.data.token)
                    store.setUserId(response.data.id)
                    router.push({ name: 'Dashboard' });

                } else {
                    error.value = response.data.data;
                    message.value = response.data.message;
                }
            } catch (error) {
                console.log(ErrorEvent)
            }
        }

        return {
            form,
            login,
            error,
            alertOpen,closeAlert,
            message
        }

    }
}
</script>