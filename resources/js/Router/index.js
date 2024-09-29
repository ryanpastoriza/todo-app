import { createRouter, createWebHistory } from 'vue-router';

import Login from '../Pages/Auth/Login.vue';
import Register from '../Pages/Auth/Register.vue';
import Home from '../Pages/Dashboard.vue';

// import Tasks from '../Pages/Task/Index.vue';
import CreateTask from '../Pages/Task/CreateTask.vue';
import EditTask from '../Pages/Task/EditTask.vue';

const routes = [
    // {
    //     path: '/',
    //     name: 'home',
    //     component: Home
    // },
	{
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Home
    },
    {
        path: '/tasks/create',
        name: 'create-task',
        component: CreateTask
    },
    {
        path: '/tasks/edit',
        name: 'edit-task',
        component: EditTask
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;