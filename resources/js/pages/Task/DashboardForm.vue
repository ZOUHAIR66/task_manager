<template>
    <div>
        <div>
            <div class="bg-sky-300  py-20 text-center text-neutral-800 bg-blue-200 dark:text-neutral-200">
                <h1 class="mb-6 text-5xl text-gray-600 font-bold">Task Manager </h1>
                <h3 class="mb-8 text-1xl text-gray-600 font-bold">Click Button To Add new Tasks</h3>
                <button
                    class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                    type="button" v-on:click="toggleModal">
                    Add New Task
                </button>

            </div>
        </div>




        <div v-if="showModal"
            class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-sm">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="  pt-5 border-b border-solid border-blueGray-200 rounded-t">
                        <h3 class="text-3xl font-semibold text-center">
                            Add New Task
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                            v-on:click="toggleModal">
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                ×
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div v-for="erro in error" :key="erro">
                            <p class="text-red-500 text-xs italic" v-for="err in erro" :key="err">{{ err }}</p>
                        </div>


                        <form @submit.prevent="addTask" class=" px-2   mb-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="task_title">
                                    Task Title
                                </label>

                                <input v-model="form.task_title"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_title" name="task_title" type="text" placeholder="task title">

                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="task_description">
                                    Task Description
                                </label>
                                <textarea v-model="form.task_description"
                                    class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_description" name="task_description" type="text"
                                    placeholder="Task Description" />
                                <p class="text-red-500 text-xs italic">{{ err }} </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mx-2"
                                    type="button" v-on:click="toggleModal">
                                    Close
                                </button>
                                <button
                                    class="background-transparent   text-blue-500 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="submit">
                                    Add
                                </button>

                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>

        <div class="container mx-auto mx-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4   gap-5   mt-10 mx-20 mb-5">
                <div v-for="task in store.tasks" :key="task.id">

                    <ListTaks :task="task" />
                </div>
            </div>
        </div>

    </div>
</template>
  
<script>

import { UserStore } from '@/store/UserStore.js';
import ListTaks from './ListTasks.vue'
import axios from "axios";
import { ref, reactive } from "vue";

export default {
    name: "DashboardForm",
    components: {
        ListTaks
    },

    setup() {

        let showModal = ref(false)

        let form = reactive({
            task_title: '',
            task_description: '',
            is_done: 0,
            user_id: null
        });

        let error = ref({});

        const store = UserStore();

        store.getTasks()

        const addTask = async () => {

            form.user_id = store.getUserId
            try {
                const response = await axios.post('api/store', form)
                if (response.data.sucess) {

                } else {
                    error.value = response.data.data
                }

            } catch (er) {
                console.log(er)
            }

            form.task_title = '',
            form.task_description = ''

            toggleModal()
            store.getTasks()
        }
        const toggleModal = () => { showModal.value = !showModal.value }

        return {
            store,
            addTask,
            form,
            error,
            showModal,
            toggleModal

        }

    },




    created() {
    },
}
</script>