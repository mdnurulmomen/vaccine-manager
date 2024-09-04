/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { capitalize, createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

/* Importing Global MenuBar */
import MenuBar from './pages/MenuBar.vue';
app.component('menu-bar', MenuBar);

/* Importing Global Components */
import MyFormModalComponent from './components/MyFormModalComponent.vue';
import NameFormModalComponent from './components/NameFormModalComponent.vue';
import LocationFormModalComponent from './components/LocationFormModalComponent.vue';
import DeleteConfirmationComponent from './components/DeleteConfirmationComponent.vue';
import ThreeGridsWithAddButtonComponent from './components/ThreeGridsWithAddButtonComponent.vue';

/* Registering Components Globally */
app.component('my-form-modal-component', MyFormModalComponent);
app.component('name-form-modal-component', NameFormModalComponent);
app.component('location-form-modal-component', LocationFormModalComponent);
app.component('delete-confirmation-component', DeleteConfirmationComponent);
app.component('three-grids-with-add-button-component', ThreeGridsWithAddButtonComponent);

/* Import Pages */
import Home from './pages/Home.vue';
import SkillIndex from './pages/SkillIndex.vue';
import MySkillIndex from './pages/MySkillIndex.vue';
import InterestIndex from './pages/InterestIndex.vue';
import LocationIndex from './pages/LocationIndex.vue';
import PoliticalPartyIndex from './pages/PoliticalPartyIndex.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name:'home', component: Home },
    { path: '/skills', name:'skills.index', component: SkillIndex },
    { path: '/my-skills', name:'my-skills.index', component: MySkillIndex },
    { path: '/interests', name:'interests.index', component: InterestIndex },
    { path: '/locations', name:'locations.index', component: LocationIndex },
    { path: '/political-parties', name:'political-parties.index', component: PoliticalPartyIndex },
];

import { createWebHistory, createRouter } from 'vue-router';

const router = createRouter({
  history: createWebHistory(),
  routes,
});

app.use(router);

/* Global Filters */
app.config.globalProperties.$filters = {
    capitalize(value) {
        if (!value) return '';

        /* Each Word Capitalization */
        const words = value.split("-");

        for (let i = 0; i < words.length; i++) {
            words[i] = words[i][0].toUpperCase() + words[i].substr(1);
        }

        return words.join(" ");
    }
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
