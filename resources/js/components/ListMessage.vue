<template>
  <section class="discussions">
        <div class="discussion search1">
          <div class="searchbar1">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Search...">  
          </div>
        </div>
        <div class="discussion" v-for="(message, index) in listMessage" :key="message.id"  @click="displayconversation(message.patient_id)">
          <img class="photo"  :src="'http://204.48.29.155:7080/profile/'+message.patient.image" />

  <div class="desc-contact">

    <p class="name">{{message.patient.name}}</p>
    <p class="message1">{{message.message}}</p>

  </div>
  <div class="timer">{{ getTimeDiff(message.created_at) }}</div>
</div>


      </section>
  </template>
  
  <script>
  export default {
    props: ['user'],
      computed: {

    },
    mounted() {
      console.log("$$$$$$$$$$$$$")
      console.log(this.user)
      console.log("$$$$$$$$$$$$$")

        this.fetchMessagesDoctor();
    },
    data() {
        return {
            listMessage: [],
        }
    },
      methods: {
        getTimeDiff(date) {
    let now = new Date();
    let created = new Date(date);
    let diff = (now - created) / 1000;
    if (diff < 60) {
      return Math.floor(diff) + ' seconds ago';
    } else if (diff < 3600) {
      return Math.floor(diff / 60) + ' minutes ago';
    } else if (diff < 86400) {
      return Math.floor(diff / 3600) + ' hours ago';
    } else {
      return created.toLocaleDateString();
    }
  },
        displayconversation(patient_id)
        {


          this.$emit('displayconversation', {
               //     user: this.user,
               patient_id: patient_id ,
               doctor_id:this.user.id
                });
        } ,
        fetchMessagesDoctor() {
            axios.get('/messages/doctor/'+this.user.id).then(response => {
                console.log(response.data)

                this.listMessage = response.data;
         //       console.log(listMessage)

            });
        },
     
      }
  };
  </script>