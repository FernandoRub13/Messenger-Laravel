<template> 
  <b-input-group>
    <b-form-input 
    placeholder="Buscar contacto" 
    v-model="search"
    class="my-2" type="text"></b-form-input>
  </b-input-group>
</template>

<script>
export default {
  computed: {
    search: {
      get() {
        return this.$store.state.search;
      },
      set(value) {
        this.$store.commit('setSearch', value);
      }
    },
  },
};
</script>