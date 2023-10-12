<template>
    <div>
        <h1
            class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl text-center mt-10">
            Register
        </h1>

        <div class="items-center flex items-center justify-center mt-10">
            <form 
                @submit.prevent="register"
                class="bg-slate-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div v-for="erro in error" :key="erro">
                    <p class="text-red-500 text-xs italic" v-for="err in erro" :key="err">{{ err }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        name
                    </label>
                    <input
                    v-model="form.name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" placeholder="name">
                    <p class="text-red-500 text-xs italic"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                    v-model="form.email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="text" placeholder="email">
                    <p class="text-red-500 text-xs italic" ></p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                    v-model="form.password"
                        class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="******************">
                    <p class="text-red-500 text-xs italic" ></p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                        Confirm Password
                    </label>
                    <input
                    v-model="form.confirm_password"
                        class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="confirm_password" type="password" placeholder="******************">
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
import { reactive, ref } from "vue";
import { useRouter } from 'vue-router'
import { UserStore } from '../store/UserStore.js'

export default {
    name: 'Register',
    setup() {

        const store = UserStore();
        const router = useRouter();

        let form = reactive({
            name: '',
            email: '',
            password: '',
            confirm_password: '',
        });

        let error = ref('');

        const register = async () => {
            try {

                const response = await axios.post('api/register', form);
                if (response.data.success) {
                    store.setToken(response.data.token)
                    store.setUserId(response.data.id)

                    router.push({ name: 'Dashboard' });
                } else {
                    error.value = response.data.data;

                }

            } catch (error) {

            }
        }

        return {
            form,
            error,
            register
        }
    }

}
</script>