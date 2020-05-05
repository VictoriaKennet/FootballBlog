require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

import router from "./router";

import AppComponent from "./components/AppComponent";

Vue.use(BootstrapVue);

const app = new Vue({
    el: '#app',
    components: {
        AppComponent
    },
    router
});
