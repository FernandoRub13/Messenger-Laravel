<template>
  <b-icon-circle-fill  
  :variant="online?'success':'secondary'" 
  :title="online?'Online':'Offline'"
  id="status-icon"
  
  ></b-icon-circle-fill>
</template>

<script>
import { BIconCircleFill } from 'bootstrap-vue'
export default {
  components: { BIconCircleFill},
  props: {
    online: {
      type: Boolean,
      default: false
    },
  }
}
</script>

<style scoped>
#status-icon {
  width: 12px;
  height: 12px;
  margin-right:5px;
}
</style>