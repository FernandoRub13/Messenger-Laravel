import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      messages: [],
    },
    mutations: {
      newMessagesList(state, messages) {
        state.messages = messages;
      },
      addMessage(state, message) {
        state.messages.push(message);
      }
    }
});