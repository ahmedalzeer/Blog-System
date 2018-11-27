require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vue from 'vue'
import moment from 'moment'
import { Form, HasError, AlertError } from 'vform'
window.form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(VueRouter)
Vue.filter('mydate',function (created) {
    return moment(created).subtract(6, 'days').calendar();
})
let fire = new Vue
window.fire =fire

let routes = [
    { path: '/posts', component: require('./components/Posts.vue') },

]
const router = new VueRouter({
    mode :'history',
    routes // short for `routes: routes`
})


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('post', require('./components/Posts.vue'));
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))


const app = new Vue({
    el: '#app',
    router
});
