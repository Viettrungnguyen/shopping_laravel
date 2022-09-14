// require('./bootstrap');


window.Vue = require('vue');
Vue.component('show-cate', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
});