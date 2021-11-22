<template>
  <div class="h-100">
    <b-row class="h-100">
      <b-col cols="8">
        <b-card
          footer-bg-variant="dark"
          footer-border-variant="dark"
          title="Title"
          class="h-100"
        >
          <div>
            <message-conversation-component v-for="message in conversation" :key="message.id" :written-by-me="message.written_by_me===1?true:false">
              {{message.content}}
            </message-conversation-component>
          </div>
          <div slot="footer">
            <b-form autocomplete="off" @submit.prevent="postMessage" >
              <b-input-group class="mb-0" inline>
                <b-form-input
                v-model="content"
                  placeholder="Escribe tu mensaje"
                  type="text"
                ></b-form-input>
                <b-button type="submit" variant="primary">Enviar</b-button>
              </b-input-group>
            </b-form>
          </div>
        </b-card>
      </b-col>
      <b-col cols="4">
        <b-img
          blank
          blank-color="#777"
          width="55"
          height="55"
          class="m-1"
          rounded="circle"
          alt="Your friend"
        />
        <p>Usuario seleccionado</p>
        <hr />
        <b-form-checkbox> Desactivar notificaciones </b-form-checkbox>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      content: '',
      conversation: [],
      contactId: 2,
    };
  },
  mounted() {
    this.getMessages();
  },
  methods: {
    getMessages() { 
      axios.get(`/api/messages?contact_id=${this.contactId}`)
      .then(response => {
        this.conversation = response.data;
        console.log(this.conversation);
      })
      .catch(error => {
        console.log(error);
      }); 
    },
    postMessage() {
      const params = {
        to_id: this.contactId,
        content: this.content,
      };

      axios.post("/api/messages", params)
      .then(response => {
        if (response.data.success) {
          this.content = '';
          this.getMessages();  
        } 
      });
    },
  },
};
</script>