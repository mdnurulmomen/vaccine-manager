/* Import Pages */
import Home from '@/pages/Home.vue';
import SkillIndex from '@/pages/SkillIndex.vue';
import MySkillIndex from '@/pages/MySkillIndex.vue';
import InterestIndex from '@/pages/InterestIndex.vue';
import MyInterestIndex from '@/pages/MyInterestIndex.vue';
import LocationIndex from '@/pages/LocationIndex.vue';
import MyLocationIndex from '@/pages/MyLocationIndex.vue';
import PoliticalPartyIndex from '@/pages/PoliticalPartyIndex.vue';
import MyPoliticalPartyIndex from '@/pages/MyPoliticalPartyIndex.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name:'home', component: Home },
    { path: '/skills', name:'skills.index', component: SkillIndex },
    { path: '/my-skills', name:'my-skills.index', component: MySkillIndex },
    { path: '/interests', name:'interests.index', component: InterestIndex },
    { path: '/my-interests', name:'my-interests.index', component: MyInterestIndex },
    { path: '/locations', name:'locations.index', component: LocationIndex },
    { path: '/my-locations', name:'my-locations.index', component: MyLocationIndex },
    { path: '/political-parties', name:'political-parties.index', component: PoliticalPartyIndex },
    { path: '/my-political-parties', name:'my-political-parties.index', component: MyPoliticalPartyIndex },
];

import { createWebHistory, createRouter } from 'vue-router';

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
