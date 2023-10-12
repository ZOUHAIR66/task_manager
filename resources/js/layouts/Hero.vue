<template>
    <div>
        <div class="bg-sky-300 px-6 py-20 text-center text-neutral-800 bg-blue-200 dark:text-neutral-200">
            <h1 class="mb-6 text-5xl text-gray-600 font-bold">Task Manager</h1>
            <h3 class="mb-8 text-1xl text-gray-600 font-bold">Get Logged To Do taskd</h3>

            <router-link :to="{ name: 'Login' }"
                class="inline-block rounded bg-blue-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                data-te-ripple-init data-te-ripple-color="light" href="#!" role="button">Login</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Hero'
}
</script>