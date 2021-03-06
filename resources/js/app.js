/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-multiselect/dist/vue-multiselect.min.css');
import VModal from 'vue-js-modal';
import VueLoading from 'vuejs-loading-plugin'
import Swal from 'sweetalert2'

window.Vue = require('vue').default;
window.Swal = require('sweetalert2');


Vue.use(VModal);
Vue.use(VueLoading);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('card-component', require('./components/Card.vue').default);
Vue.component('menu-container', require('./modules/menu/MenuContainer.vue').default);
Vue.component('resto-group', require('./modules/restaurant/RestoGroup.vue').default);
Vue.component('order-group', require('./modules/orders/OrderGroup.vue').default);
Vue.component('manage-orders', require('./modules/orders/ManageOrders.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.eventBus = new Vue({});

const app = new Vue({
    el: '#app',
});
  