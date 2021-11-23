<template>
  <div class="h-100">
    <b-row class="h-100">
      <b-col cols="8">
        <b-card
          no-body
          footer-bg-variant="dark"
          footer-border-variant="dark"
          title="Title"
          class="h-100"
        >
          <b-card-body class="card-body-scroll">
            <message-conversation-component
              v-for="message in messages"
              :key="message.id"
              :written-by-me="
                message.written_by_me === 1 || message.written_by_me
                  ? true
                  : false
              "
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
          blank
          blank-color="#777"
          width="55"
          height="55"
          class="m-1"
          rounded="circle"
          alt="Your friend"
        />
        <p>{{ contactName }}</p>
        <hr />
        <b-form-checkbox> Desactivar notificaciones </b-form-checkbox>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  props: {
    contactId: {
      type: Number,
      required: true,
    },
    contactName: {
      type: String,
      required: true,
    },
    messages: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      content: "",
    };
  },
  mounted() {},
  methods: {
    postMessage() {
      const params = {
        to_id: this.contactId,
        content: this.content,
      };

      axios.post("/api/messages", params).then((response) => {
        if (response.data.status == "success") {
          this.content = "";
          const message = response.data.message;
          message.written_by_me = true;
          this.$emit("messageCreated", message); 
        }
      });
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