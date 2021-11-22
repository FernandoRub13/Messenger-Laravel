<template>  
  <div>
    <b-input-group>
      <b-form-input placeholder="Buscar contacto" class="my-2" type="text"></b-form-input>
  </b-input-group>
  <b-list-group>
    <!-- <contact-component variant="dark"></contact-component>
    <contact-component></contact-component>
    <contact-component variant="light"></contact-component> -->
    <contact-component v-for="conversation in conversations" :key="conversation.id" :conversation="conversation"></contact-component>
  </b-list-group>
  </div>
</template>

<script>
import ContactComponent from './ContactComponent.vue';
export default {
  components: { ContactComponent },
  data() {
    return {
      conversations: [],
    };
  },
  mounted() {
    this.getConversations();
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
    }
  }
}
</script>