require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('event-slot', require('./components/EventSlot.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});