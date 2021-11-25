/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue').default;
import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// window.eventBus = new Vue(); // Global event bus  
//import store
import store from './store'
import MessengerComponent from './components/MessengerComponent' 
import ExampleComponent from './components/ExampleComponent'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
// use vue-router
Vue.use(VueRouter)


Vue.component('contact-component', require('./components/ContactComponent.vue').default);
Vue.component('contact-list-component', require('./components/ContactListComponent.vue').default);
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue').default);
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue').default);
// Vue.component('messenger-component', require('./components/MessengerComponent.vue').default);

Vue.component('status-component', require('./components/StatusComponent.vue').default);
Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue').default);
Vue.component('contact-form-component', require('./components/ContactFormComponent.vue').default);

const routes = [
    {path: '/chat', component: MessengerComponent},
    {path: '/chat/:conversationId', component: MessengerComponent},
    {path: '/example', component: ExampleComponent},
]

const router = new VueRouter({
    routes,
    mode: 'history'

})

const app = new Vue({
    el: '#app',
    store,
    router,
});
