/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('vue-login', require('./components/login.vue').default);
Vue.component('vue-register', require('./components/register.vue').default);

import ChatApp from './components/ChatApp'
import ShowCounsellors from './components/ShowCounselors.vue'
import FaqPage from './components/FAQ.vue'

import Dashboard from './components/admin/Dashboard.vue'
import User from './components/admin/User.vue'
import Counsellor from './components/admin/Counsellor.vue'
import Student from './components/admin/Student.vue'
import Admins from './components/admin/Admins.vue'
import Archive from './components/admin/Archive.vue'

const app = new Vue({
    el: '#app',
    components:{
        ChatApp
    },
});

const counsellors = new Vue({
    el: '#counsellors',
    components:{
        ShowCounsellors
    },
});

const faq = new Vue({
    el: '#faq',
    components:{
        FaqPage
    },
});

const admin = new Vue({
    el: '#admin',
    components:{
        Dashboard,
        User,
        Counsellor,
        Admins,
        Student,
        Archive,
    },
});
