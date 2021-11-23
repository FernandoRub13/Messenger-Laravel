<template>  
  <div>
    <b-input-group>
      <b-form-input placeholder="Buscar contacto" class="my-2" type="text"></b-form-input>
  </b-input-group>
  <b-list-group>
    <!-- <contact-component variant="dark"></contact-component>
    <contact-component></contact-component>
    <contact-component variant="light"></contact-component> -->
    <contact-component 
    v-for="conversation in conversations" 
    :key="conversation.id" 
    :conversation="conversation"
    @click.native="selectConversation(conversation)">
    ></contact-component>
  </b-list-group>
  </div>
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