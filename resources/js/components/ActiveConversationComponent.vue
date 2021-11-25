<template>
  <div class="h-100">
    <b-row class="h-100">
      <b-col cols="8">
        <b-card
          no-body
          footer-bg-variant="dark"
          footer-border-variant="dark"
          class="h-100"
        >
          <b-card-body class="card-body-scroll">
            <message-conversation-component
              v-for="message in  messages"
              :key="message.id"
              :written-by-me="
                message.written_by_me === 1 || message.written_by_me
                  ? true
                  : false
              "
              :image="message.written_by_me ? myImage : selectedConversation.contact_image"
            >
              {{ message.content }}
            </message-conversation-component>
          </b-card-body>
          <div slot="footer">
            <b-form autocomplete="off" @submit.prevent="postMessage">
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
          :src="selectedConversation.contact_image"
          width="55"
          height="55"
          class="m-1"
          rounded="circle"
          alt="Your friend"
        />
        <p>{{ selectedConversation.contact_name }}</p>
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
      content: "",
    };
  },
  computed: {
    messages() {
      return this.$store.state.messages;
    },
    selectedConversation() {
      return this.$store.state.selectedConversation;
    },
    myImage(){
      return '/users/' + this.$store.state.user.image;
    }, 
  },
  mounted() {
    // eventBus.$on("example", (message) => {
    //   console.log("Ocurrió el evento example");
    //   console.log(message);

    // });
  },
  methods: {
    postMessage() {
      this.$store.dispatch("postMessage", this.content);
    },
    scrollToBottom() {
      const element = document.getElementsByClassName("card-body-scroll")[0];
      element.scrollTop = element.scrollHeight;
    },
  },
  updated() {
    this.scrollToBottom();
    console.log("messages changed");
  },
};
</script>

<style>
.card-body-scroll {
  max-height: calc(100vh - 92px);
  overflow-y: auto;
}
</style>