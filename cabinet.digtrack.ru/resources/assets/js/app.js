
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
Vue.component('department-new-component', require('./components/DepartmentNewComponent.vue'));
Vue.component('department-page-component', require('./components/DepartmentPageComponent.vue'));
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('customers-table-component', require('./components/CustomersTableComponent.vue'));
Vue.component('customer-page-component', require('./components/CustomerPageComponent.vue'));

Vue.component('positions-table-component', require('./components/PositionsTableComponent.vue'));


Vue.component('teach-component', require('./components/TeachComponent.vue'));
Vue.component('test-component', require('./components/TestComponent.vue'));

const app = new Vue({
    el: '#app'
});
