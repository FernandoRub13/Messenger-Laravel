<template>  
  <b-list-group>
    <contact-component 
    v-for="conversation in conversationsFiltered" 
    :key="conversation.id" 
    :conversation="conversation"
    :selected="isSelected(conversation)"
    @click.native="selectConversation(conversation)">
    ></contact-component>
  </b-list-group>
</template>

<script>
import ContactComponent from './ContactComponent.vue';
export default {
  components: { ContactComponent }, 
  methods: {
    
    selectConversation(conversation) {
      this.$store.dispatch('getMessages', conversation);
      this.$router.push(`/chat/${conversation.id}`);
    },
    isSelected(conversation) {
      if(this.selectedConversation)
        return this.selectedConversation.id === conversation.id;
      return false;
    },
  },
  computed: {
    selectedConversation() {
      return this.$store.state.selectedConversation;
    },
    conversationsFiltered() {
      return this.$store.getters.conversationsFiltered;
    },
  },
}
</script>