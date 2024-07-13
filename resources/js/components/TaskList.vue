<template>
    <div>
        <h1>Tasks</h1>
        <ul>
            <li v-for="task in tasks" :key="task.id">
                {{ task.title }}
                <button @click="editTask(task)">Edit</button>
                <button @click="deleteTask(task.id)">Delete</button>
            </li>
        </ul>
        <form @submit.prevent="createTask">
            <input v-model="newTask.title" placeholder="Title">
            <input v-model="newTask.description" placeholder="Description">
            <button type="submit">Add Task</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tasks: [],
            newTask: {
                title: '',
                description: ''
            }
        }
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks() {
            axios.get('/api/tasks')
                .then(response => {
                    this.tasks = response.data;
                });
        },
        createTask() {
            axios.post('/api/tasks', this.newTask)
                .then(response => {
                    this.tasks.push(response.data);
                    this.newTask.title = '';
                    this.newTask.description = '';
                });
        },
        deleteTask(id) {
            axios.delete(`/api/tasks/${id}`)
                .then(response => {
                    this.tasks = this.tasks.filter(task => task.id !== id);
                });
        },
        editTask(task) {
            // Implementar funcionalidade de edição
        }
    }
}
</script>
