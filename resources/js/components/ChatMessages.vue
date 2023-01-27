<template>
  <div class="chat">
    <div v-for="(message, index) in messages" :key="message.id" :class="[message.user.role_id === 1 ? 'yours' : 'mine', 'messages']">
      <div class="message" :class="{ 'last': isLastMessage(message) }">
        {{ message.message }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: ['messages'],
    computed: {
    lastMessageByRole() {
      let lastMessageByRole = {};
      for (let message of this.messages) {
        let role = message.user.role_id;
        lastMessageByRole[role] = message;
      }
      return lastMessageByRole;
    },
  },
    methods: {
      isLastMessage(message) {
        let role = message.user.role_id;
      return (
        message === this.lastMessageByRole[role] && 
        (role === 1 || role === 3)
      );
    },
    }
};
</script>