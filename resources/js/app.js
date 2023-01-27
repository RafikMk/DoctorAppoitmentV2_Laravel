require('./bootstrap');

window.Vue = require('vue');

Vue.component('find-doctors', require('./components/FindDoctors.vue').default);
Vue.component('input-field', require('./components/InputField.vue').default);

Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
import {pusher} from './pusher'

const app = new Vue({
    el: '#app',
    data: {
        messages: []
    },
     

    created() {
           
      const channel = pusher.subscribe('doctor_1');
      console.log(channel) ;
      channel.bind('patient_2', (data) => {
        console.log("channel name is: ", channel.name);
       this.messages.push(data)
      
        console.log(JSON.stringify(data));
        });
        this.fetchMessages();

    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
      //      this.messages.push(message);

            axios.post('/messages', message).then(response => {
              console.log(response.data);
            });
        }
    }

});
