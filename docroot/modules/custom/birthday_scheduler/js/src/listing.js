import Vue from 'vue';

import CurrentDateTime from './Components/CurrentDateTime.vue';
import Birthday from './Components/Birthday.vue';


const app = new Vue({
  el: '#birthday_scheduler_root',
  components: {
    'current-date-time': CurrentDateTime,
    'birthday': Birthday,
  },

  data() {
    return {

    }
  },
  methods: {
  },
});
