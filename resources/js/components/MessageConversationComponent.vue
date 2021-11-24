<template>
   <b-media :right-align="writtenByMe" vertical-align="true" class="mb-2" >
     <b-img rounded="circle" slot="aside" :src="image" width="48" height="48" alt="placeholder" />
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
    },
    image: {
      type: String,
      default: ''
    }
  },

};
</script>