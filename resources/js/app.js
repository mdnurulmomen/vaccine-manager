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
import NameFormModalComponent from './components/NameFormModalComponent.vue';
import DeleteConfirmationComponent from './components/DeleteConfirmationComponent.vue';
import ThreeGridsWithAddButtonComponent from './components/ThreeGridsWithAddButtonComponent.vue';

/* Registering Components Globally */
app.component('name-form-modal-component', NameFormModalComponent);
app.component('delete-confirmation-component', DeleteConfirmationComponent);
app.component('three-grids-with-add-button-component', ThreeGridsWithAddButtonComponent);

/* Import Pages */
import Home from './pages/Home.vue';
import SkillIndex from './pages/SkillIndex.vue';
import InterestIndex from './pages/InterestIndex.vue';
import LocationIndex from './pages/LocationIndex.vue';

const routes = [
    { path: '/', redirect: '/home' },
    { path: '/home', name:'home', component: Home },
    { path: '/skills', name:'skills.index', component: SkillIndex },
    { path: '/interests', name:'interests.index', component: InterestIndex },
    { path: '/locations', name:'locations.index', component: LocationIndex },
];

import { createMemoryHistory, createRouter } from 'vue-router';

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});

app.use(router);

/* Global Filters */
app.config.globalProperties.$filters = {
    capitalize(value) {
        if (!value) return '';
        value = value.toString();
        return value.charAt(0).toUpperCase() + value.slice(1);
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
