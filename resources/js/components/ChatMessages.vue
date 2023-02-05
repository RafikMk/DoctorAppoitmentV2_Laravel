<template>
  <div class="chat">
  
   <ul class="list-unstyled" v-for="(message, index) in messages" :key="message.id">
          <li class="d-flex justify-content-between mb-4">
            <img v-if="message.envoye_par === message.doctor_id "   :src="'http://204.48.29.155:7080/profile/'+message.doctor.image"  alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
            <div class="card" :class="[message.envoye_par === message.doctor_id ? 'card_doctor' : '']">
              <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">{{ message.envoye_par === message.doctor_id ? message.doctor.name : message.patient.name }}</p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{ getTimeDiff(message.created_at) }}</p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  {{ message.message }}   
                </p>
              </div>
            </div>

            <img v-if="message.envoye_par === message.patient_id " :src="'http://204.48.29.155:7080/profile/'+message.patient.image" alt="avatar"
              class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
          </li>

      
        </ul>
      </div>

</template>

<script>
export default {
    props: ['messages'],
    computed: {
    lastMessageByRole() {
      let lastMessageByRole = {};
      for (let message of this.messages) {
        let role = message.role_id;
        lastMessageByRole[role] = message;
      }
      return lastMessageByRole;
    },
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
      isLastMessage(message) {
        let role = message.role_id;
      return (
        message === this.lastMessageByRole[role] && 
        (role === 1 || role === 3)
      );
    },
    }
};
</script>
<style>
.card_doctor
{
  border-color: #ccc;
    background-color: #ddd;
}
.card_patient
{
  border: 2px solid #dedede;
    background-color: #f1f1f1;
}
</style>