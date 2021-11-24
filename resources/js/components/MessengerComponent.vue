<template>
  <b-container fluid class="h-100">
    <b-row no-gutters class="h-100">
      <b-col cols="4">
        <b-input-group>
            <b-form-input 
            placeholder="Buscar contacto" 
            v-model="search"
            class="my-2" type="text"></b-form-input>
        </b-input-group>
        <contact-list-component
          @conversationSelected="changeActiveConversation($event)"
          :conversations="conversationsFiltered"
        ></contact-list-component>
      </b-col>
      <b-col cols="8">
        <active-conversation-component
          v-if="selectedConversation"
          :contact-id="selectedConversation.contact_id"
          :contact-name="selectedConversation.contact_name"
          :contact-image="selectedConversation.contact_image"
          :messages="messages"
          @messageCreated="addMessage($event)"
          :my-image="myImageUrl"
        ></active-conversation-component>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  props: { 
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      selectedConversation: null,
      messages: [],
      conversations: [],
      search: '',
    };
  },
  mounted() {
    this.getConversations();
    console.log(this.user.id);
    Echo.join("users." + this.user.id).listen("MessageSent", (data) => {
      const message = data.message;
      message.written_by_me = false;
      this.addMessage(message);
      console.log(message.created_at);
    });
    Echo.join("messenger")
      .here((users) => users.forEach((user) => this.changeStatus(user, true)))
      .joining((user) => this.changeStatus(user, true))
      .leaving((user) => this.changeStatus(user, false));
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
       console.log(message);
      const conversation = this.conversations.find((conversation) =>
       conversation.contact_id == message.from_id || 
       conversation.contact_id == message.to_id
      )
      const author = this.user.id === message.from_id ? 'Tú: ' : conversation.contact_name + ': ';
      conversation.last_message = `${author}: ${message.content}`;
      conversation.last_time = message.created_at;

      if (this.selectedConversation.contact_id == message.from_id
        || this.selectedConversation.contact_id == message.to_id) {
         
        this.messages.push(message);
      }
    },
    changeStatus(user, status) {
      this.conversations.find((conversation) => {
        if (conversation.contact_id === user.id) {
          this.$set(conversation, "online", status);
        }
      });
    },
  },
  computed: {
    conversationsFiltered() {
      return this.conversations.filter((conversation) => {
        return conversation
        .contact_name.toLowerCase()
        .includes(this.search.toLowerCase());
      });
    },
    myImageUrl() {
      return '/users/' +this.user.image;
    },
    
  },
};
</script>