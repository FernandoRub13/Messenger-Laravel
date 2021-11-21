<template>
   <b-media :right-align="writtenByMe" vertical-align="true" class="mb-2" >
     <b-img rounded="circle" slot="aside" blank blank-color="#ccc" width="48" alt="placeholder" />
     <b-card>
       <slot></slot>
     </b-card>
   </b-media>
</template>

<script>
export default {
  props: {
    writtenByMe: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      content: 'abc',
    }
  },

};
</script>