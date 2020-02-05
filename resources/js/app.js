// require('./bootstrap');

import Vue from 'vue'

import vSelect from 'vue-select'

import './components/plugins/'

window.Vue = Vue;

Vue.component('v-select', vSelect);
Vue.component('DatePicker', require('./components/global/datePicker/datePicker').default);
Vue.component('MyVuetable', require('./components/global/table/table').default);

Vue.component('students', require('./components/student/index').default);
Vue.component('classes', require('./components/classes/index').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
