import { createRouter, createWebHistory } from 'vue-router';
import EmployeeIndex from '../components/employee/index.vue';
import NotFound from '../components/NotFound.vue';

const routes = [
    {
        path: '/',
        name: 'EmployeeIndex',
        component: EmployeeIndex
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;