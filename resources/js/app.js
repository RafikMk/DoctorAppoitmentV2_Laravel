require('./bootstrap');

window.Vue = require('vue');

Vue.component('find-doctors', require('./components/FindDoctors.vue').default);
Vue.component('input-field', require('./components/InputField.vue').default);

Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('list-messages', require('./components/ListMessage.vue').default);

import {pusher} from './pusher'

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        listMessage: [],
        patient_id:0 ,doctor_id:0
    },
     

    created() {
           
   /*   const channel = pusher.subscribe('doctor_1');
      console.log(channel) ;
      channel.bind('patient_2', (data) => {
        console.log("channel name is: ", channel.name);
       this.messages.push(data)
      
        console.log(JSON.stringify(data));
        });  */
     //   this.fetchMessages();
    },

    methods: {
      displayconversation(data)
      {     
       // console.log(data.patient_id)
     //   console.log(data.doctor_id)
this.patient_id=data.patient_id
this.doctor_id=data.doctor_id
this.fetchMessages(data.patient_id,data.doctor_id)
      },
        change(newId) {
         //   newId=1
     //     console.log(newId.id)
    /*    const channel = pusher.subscribe(`doctor_${newId.newId}`);
        console.log(channel) ;
        channel.bind('patient_2', (data) => {
          console.log("channel name is: ", channel.name);
         this.messages.push(data)
        
          console.log(JSON.stringify(data));
          });*/
            },
        fetchMessages(patient_id,doctor_id) {
          const channel = pusher.subscribe(`doctor_${doctor_id}`);
          console.log(channel) ;
          channel.bind(`patient_${patient_id}`, (data) => {
            console.log("channel name is: ", channel.name);
           this.messages.push(data)
          
            console.log(JSON.stringify(data));
            });
            axios.get(`/messages/doctor/${doctor_id}/patient/${patient_id}`).then(response => {
                console.log(response.data)
                this.messages = response.data;
            });
        },
  
        addMessage(message) {
      //      this.messages.push(message);

            axios.post('/messages',{message:message.message ,patient_id:this.patient_id ,doctor_id :this.doctor_id} ).then(response => {
              console.log(response.data);
            });
        }
    }

});
