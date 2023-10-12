<template>
    <div
        class="block max-w-sm p-6   rounded-2xl shadow hover:bg-sky-500 bg-sky-400  dark:hover:bg-sky-500/100">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ task.task_title }}</h5>
        <p class="font-normal text-gray-200 dark:text-gray-200">{{ task.task_description }}</p>
        <div class="grid  grid-rows-1 grid-cols-2  pt-5 mt-10 ">
            <button @click="updateTasks(task.id)" v-if="task.is_done == 1">
                <p class="italic">completed</p>
            </button>
            <a @click="updateTasks(task.id)" v-else>
                <i class="material-icons text-sky-200 text-3xl  pl-4 cursor-pointer" >done_all</i>
            </a>
            <a @click="deleteTasks(task.id)"><i
                    class="material-icons text-sky-950 text-3xl pl-16 cursor-pointer">delete_forever</i></a>
        </div>
    </div>
</template>

<script>
import { UserStore } from '@/store/UserStore.js';

export default {
    name: 'ListTaks',
    props: ['task']
    ,

    methods: {
        deleteTasks(id) {
            const store = UserStore()
            const response = axios.delete('api/delete/' + id)
                .then(response => {
                    this.tasks = response.data
                    store.getTasks()
                }).catch(error => console.log(error))
        }
        ,

        updateTasks(id) {
            const store = UserStore()
            const response = axios.put('api/update/' + id).then(res => {
                if (res.status == 200) {
                    store.getTasks()
                }
            }).catch(error => console.log(error))
        }
    }
}

</script>

<style>
.completed {
    color: rgb(12 74 110);
}

</style>