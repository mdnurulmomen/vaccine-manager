/* Import Pages */
import Home from '@/pages/Home.vue';
import UserVaccineIndex from '@/pages/UserVaccineIndex.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name:'home', component: Home },
    { path: '/user-vaccines', name:'user-vaccines.index', component: UserVaccineIndex },
];

import { createWebHistory, createRouter } from 'vue-router';

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
