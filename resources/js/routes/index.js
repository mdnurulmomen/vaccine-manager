/* Import Pages */
import Home from '@/pages/Home.vue';
import UserVaccineIndex from '@/pages/UserVaccineIndex.vue';
import VaccineCenterIndex from '@/pages/VaccineCenterIndex.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name:'home', component: Home },
    { path: '/user-vaccines', name:'user-vaccines.index', component: UserVaccineIndex },
    { path: '/vaccine-centers', name:'vaccine-centers.index', component: VaccineCenterIndex },
];

import { createWebHistory, createRouter } from 'vue-router';

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
