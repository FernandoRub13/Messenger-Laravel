<template>
  <b-container fluid class="h-100">
    <b-row no-gutters class="h-100">
      <b-col cols="4">
        <contact-form-component />
        <contact-list-component />
      </b-col>
      <b-col cols="8">
        <active-conversation-component
          v-if="selectedConversation" />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapMutations } from 'vuex';
export default {
  props: { 
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      conversations: [],
    };
  },
  mounted() {
    this.$store
      .dispatch('getConversations')
      .then(() => {
        const conversationId = this.$route.params.conversationId;
        if(conversationId) {
          const conversation = this.$store.getters.getConversationById(conversationId);

          this.$store.dispatch('getMessages', conversation);
          // console.log('conversation', conversation);
        }
      });

    this.$store.commit('setUser', this.user);
    console.log(this.user.id);
    Echo.join("users." + this.user.id).listen("MessageSent", (data) => {
      const message = data.message;
      message.written_by_me = false;
      this.addMessage(message);
      // this.$store.commit('addMessage', message); 
    });
    Echo.join("messenger")
      .here((users) => users.forEach((user) => this.changeStatus(user, true)))
      .joining((user) => this.changeStatus(user, true))
      .leaving((user) => this.changeStatus(user, false));
  },
  methods: {
    changeStatus(user, status) {
      this.$store.state.conversations.find((conversation) => {
        if (conversation.contact_id === user.id) {
          this.$set(conversation, "online", status);
        }
      });
    },
    ...mapMutations([
      'addMessage',
    ]),
  },
  computed: {
    selectedConversation() {
      return this.$store.state.selectedConversation;
    },
    
    
  },
};
</script>