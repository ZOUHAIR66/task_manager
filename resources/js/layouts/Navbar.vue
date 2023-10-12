<template>
  <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-sky-500 ">
    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
      <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
        <router-link :to="{ name: 'Home' }" v-if="token == 0"
          class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
          href="#!" data-te-nav-link-ref data-te-ripple-init data-te-ripple-color="light">Home</router-link>

        <a v-else class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
          href="#">
          Task Manager
        </a>
        <button
          class="text-white  cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
          type="button" v-on:click="toggleNavbar()">
          <i class="material-icons">menu</i>
        </button>
      </div>
      <div v-bind:class="{ 'hidden': !showMenu, 'flex': showMenu }" class="lg:flex lg:flex-grow items-center">
        <ul class="flex flex-col lg:flex-row list-none ml-auto">
          <li class="nav-item">
            <router-link :to="{ name: 'Dashboard' }" v-if="token != 0"
              class="block font-bold transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:hover:text-white dark:focus:text-white lg:p-2 [&.active]:text-black/90"
              href="#!" data-te-nav-link-ref data-te-ripple-init data-te-ripple-color="light">Dashboard</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Login' }" data-te-ripple-init data-te-ripple-color="light" v-if="token == 0"
              class="block font-bold transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:hover:text-white dark:focus:text-white lg:p-2 [&.active]:text-black/90">
              Login
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Register' }" data-te-ripple-init data-te-ripple-color="light" v-if="token == 0"
              class="block font-bold transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:hover:text-white dark:focus:text-white lg:p-2 [&.active]:text-black/90">
              Register
            </router-link>
          </li>
          <li class="nav-item">
            <button v-if="token != 0"
              class="block font-bold transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 disabled:text-black/30 dark:hover:text-white dark:focus:text-white lg:p-2 [&.active]:text-black/90"
              type="submit" @click="logout">Logout</button>

          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { useRouter } from 'vue-router'
import { UserStore } from '../store/UserStore.js';
import { mapState } from 'pinia'

export default {
  name: 'Navbar',
  computed: {
    ...mapState(UserStore, ['token'])
  },

  setup() {

    const router = useRouter();
    const store = UserStore();
    function logout() {

      store.removeToken();
      store.removeUserId()
      router.push({ name: 'Home' });
    }

    return {
      logout
    }
  }
  ,
  data() {
    return {
      showMenu: false
    }
  },
  methods: {
    toggleNavbar: function () {
      this.showMenu = !this.showMenu;
    }
  }
}
</script>