<template>
  <b-container fluid  class="h-100" >
    <b-row no-gutters class="h-100">
        <b-col cols="4">
            <contact-list-component @conversationSelected="changeActiveConversation($event)" ></contact-list-component>
        </b-col>
        <b-col cols="8">
            <active-conversation-component 
            v-if="selectedConversation" 
            :contact-id="selectedConversation.contact_id" 
            :contact-name="selectedConversation.contact_name"
            :messages="messages"
            ></active-conversation-component>
        </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  props: {
      userId: {
        type: Number,
        required: true
      },
    },
  data() {
    return {
      selectedConversation: null,
      messages: []
    };
  },
  mounted() {
    console.log(this.userId);
    Echo.channel('example')
    .listen('MessageSent', (data) => {
      const message = data.message;
      message.written_by_me = (this.userId == message.from_id);
      console.log(this.userId);
      console.log(message.from_id);
      console.log(message.written_by_me);
      this.messages.push(message);
    }); 
  },
  methods: {
    
    changeActiveConversation(conversation) {
      this.selectedConversation = conversation;
      this.getMessages(); 

    },
    getMessages() { 
      axios.get(`/api/messages?contact_id=${this.selectedConversation.contact_id}`)
      .then(response => {
        this.messages = response.data;
        // console.log(this.messages);
      })
      .catch(error => {
        console.log(error);
      }); 
    },
  }
}
</script>