require('./bootstrap');

Vue.component('chart', require('./components/Chart.vue'));

const app = new Vue({
    el: '#app'
});
