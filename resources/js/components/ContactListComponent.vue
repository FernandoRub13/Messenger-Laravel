<template>  
  <b-list-group>
    <contact-component 
    v-for="conversation in conversations" 
    :key="conversation.id" 
    :conversation="conversation"
    @click.native="selectConversation(conversation)">
    ></contact-component>
  </b-list-group>
</template>

<script>
import ContactComponent from './ContactComponent.vue';
export default {
  components: { ContactComponent },
  props: {
    conversations: {
      type: Array,
      required: true
    },
  },
  data() {
    return {
    
    };
  },
  mounted() {
   
  },
  methods: {
    
    selectConversation(conversation) {
      this.$emit('conversationSelected', conversation);
      // console.log(conversation);
    },
  }
}
</script>