require('./bootstrap');

// Vue2
// window.Vue = require('vue').default;
// Vue.component('event-slot', require('./components/EventSlot.vue').default);
// Vue.component('event-slot-empty', require('./components/EventSlotEmpty.vue').default);
// const app = new Vue({
//     el: '#app',
// });


//Vue 2
import { createApp, ref } from 'vue';

import EventSlot from './components/EventSlot.vue'
import EventSlotEmpty from './components/EventSlotEmpty.vue'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'

createApp({
    components: {
        EventSlot,
        EventSlotEmpty,
        TabGroup,
        TabList,
        Tab,
        TabPanels,
        TabPanel,
    },

}).mount("#app")