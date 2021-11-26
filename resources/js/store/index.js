import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      messages: [],
      selectedConversation: null,
      conversations: [],
      search: '',
      user: null,
    },
    mutations: {
      setUser(state, user) {
        state.user = user;
      },
      newMessagesList(state, messages) {
        state.messages = messages;
      },
      addMessage(state, message) {
        console.log(message);
       const conversation = state.conversations.find((conversation) =>
        conversation.contact_id == message.from_id || 
        conversation.contact_id == message.to_id
       )
       const author = state.user.id === message.from_id ? 'Tú: ' : conversation.contact_name + ': ';
       conversation.last_message = `${author}: ${message.content}`;
       conversation.last_time = message.created_at;
 
        if (state.selectedConversation.contact_id == message.from_id
         || state.selectedConversation.contact_id == message.to_id) {
          state.messages.push(message);
        }
     },
      setSelectedConversation(state, conversation) {
        state.selectedConversation = conversation;
      },
      setSearch(state, search) {
        state.search = search;
      },
      newConversationsList(state, conversations) {
        state.conversations = conversations;
      }
    },
    actions: {
      getMessages(context, conversation) {
        return axios
          .get(`/api/messages?contact_id=${conversation.contact_id}`)
          .then(response => {
            context.commit('setSelectedConversation', conversation)
            context.commit('newMessagesList', response.data)
          })
          .catch(error=> console.log(error));
      },
      getConversations(context) {
        return axios.get('/api/conversations')
          .then(response => {
            context.commit('newConversationsList', response.data)
          })
          .catch(error => {
            console.log(error);
          });
      },
      postMessage(context, message) {
        const params = {

          to_id: context.state.selectedConversation.contact_id,
          content: message,
        };
        // console.log(context.state.selectedConversation.id);
        // return
        return axios.post("/api/messages", params).then((response) => {
          if (response.data.status == "success") {
            // content = "";
            const message = response.data.message;
            message.written_by_me = true;
            context.commit("addMessage", message); 
          }
        });
      }
    },
    getters: { 
      conversationsFiltered(state) {
        return state.conversations.filter(conversation => 
         conversation
          .contact_name.toLowerCase()
          .includes(state.search.toLowerCase())
        );
      },
      getConversationById(state) {
        return function (conversationId) {
          return state.conversations.find(conversation => conversation.id == conversationId)
        }
      },
    }

});