
require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue';
import { Form, HasError, AlertError } from 'vform'


import Snotify, { SnotifyPosition } from 'vue-snotify'

window.Form = Form

const Snotifyoptions = {
  toast: {
    position: SnotifyPosition.rightTop
  }
}

Vue.use(Snotify, Snotifyoptions)



Vue.component('vue-component', require('./components/VueComponent.vue').default);
Vue.component('pagination-component', require('./components/partial/PaginationComponent.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('customer-component', require('./components/CustomerComponent.vue').default);
Vue.component('customeredit-component', require('./components/CustomerEditComponent.vue').default);

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
