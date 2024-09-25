/* Import Pages */
import Home from '@/pages/Home.vue';
import SkillIndex from '@/pages/SkillIndex.vue';
import UserSkillIndex from '@/pages/UserSkillIndex.vue';
import InterestIndex from '@/pages/InterestIndex.vue';
import UserInterestIndex from '@/pages/UserInterestIndex.vue';
import LocationIndex from '@/pages/LocationIndex.vue';
import UserLocationIndex from '@/pages/UserLocationIndex.vue';
import PoliticalPartyIndex from '@/pages/PoliticalPartyIndex.vue';
import UserPoliticalPartyIndex from '@/pages/UserPoliticalPartyIndex.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name:'home', component: Home },
    { path: '/skills', name:'skills.index', component: SkillIndex },
    { path: '/my-skills', name:'user-skills.index', component: UserSkillIndex },
    { path: '/interests', name:'interests.index', component: InterestIndex },
    { path: '/my-interests', name:'user-interests.index', component: UserInterestIndex },
    { path: '/locations', name:'locations.index', component: LocationIndex },
    { path: '/my-locations', name:'user-locations.index', component: UserLocationIndex },
    { path: '/political-parties', name:'political-parties.index', component: PoliticalPartyIndex },
    { path: '/my-political-parties', name:'user-political-parties.index', component: UserPoliticalPartyIndex },
];

import { createWebHistory, createRouter } from 'vue-router';

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
