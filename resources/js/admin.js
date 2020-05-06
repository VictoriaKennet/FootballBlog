require('./bootstrap');

import router from "./routes/admin";
import Vuetify from "vuetify";

window.Vue = require('vue');
window.Vue.use(Vuetify);

import Navigation from './components/admin/includes/Navigation';
import LoginComponent from './components/admin/Login';

import uk from 'vuetify/src/locale/uk.ts';

const app = new Vue({
    el: '#admin',
    components: {
        Navigation,
        LoginComponent
    },
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi',
        },
        lang: {
            locales: { uk },
            current: 'uk',
        },
    }),
    router
});