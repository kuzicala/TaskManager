import Vue from "vue";
import VueResource from "vue-resource";
var Search = require('./componets/search.vue');
Vue.use(VueResource);

var app = new Vue({
    el:'#app-navbar-collapse',
    components:{ Search }
});