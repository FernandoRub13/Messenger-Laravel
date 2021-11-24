<template>
  <b-container fluid class="h-100">
    <b-row no-gutters class="h-100">
      <b-col cols="4">
        <contact-list-component
          @conversationSelected="changeActiveConversation($event)"
          :conversations="conversations"
        ></contact-list-component>
      </b-col>
      <b-col cols="8">
        <active-conversation-component
          v-if="selectedConversation"
          :contact-id="selectedConversation.contact_id"
          :contact-name="selectedConversation.contact_name"
          :messages="messages"
          @messageCreated="addMessage($event)"
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
      required: true,
    },
  },
  data() {
    return {
      selectedConversation: null,
      messages: [],
      conversations: [],
    };
  },
  mounted() {
    this.getConversations();
    console.log(this.userId);
    Echo.private("users." + this.userId).listen("MessageSent", (data) => {
      const message = data.message;
      message.written_by_me = false;
      this.addMessage(message);
      console.log(message.created_at);
    });
  },
  methods: {
    getConversations() {
      axios.get('/api/conversations')
        .then(response => {
          this.conversations = response.data;
          console.log(this.conversations);
        })
        .catch(error => {
          console.log(error);
        });
    },
    changeActiveConversation(conversation) {
      this.selectedConversation = conversation;
      this.getMessages();
    },
    getMessages() {
      axios
        .get(`/api/messages?contact_id=${this.selectedConversation.contact_id}`)
        .then((response) => {
          this.messages = response.data;
          // console.log(this.messages);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addMessage(message) {
      const conversation = this.conversations.find(
        (conversation) => conversation.contact_id === message.from_id || conversation.contact_id === message.to_id
      )
      const author = this.userId === message.from_id ? 'Tú: ' : conversation.contact_name + ': ';
      conversation.last_message = `${author}: ${message.content}`;
      conversation.last_time = message.created_at;

      if (this.selectedConversation.contact_id == message.from_id
        || this.selectedConversation.contact_id == message.to_id) {
        this.messages.push(message);
      }
    },
  },
};
</script>