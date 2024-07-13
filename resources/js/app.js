import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import TaskList from './components/TaskList.vue';

const routes = [
    { path: '/tasks', component: TaskList }
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: '#app',
    router
});
