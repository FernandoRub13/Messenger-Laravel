<template>  
  <div>
    <b-input-group>
      <b-form-input placeholder="Buscar contacto" class="my-2" type="text"></b-form-input>
  </b-input-group>
  <b-list-group>
    <contact-component variant="dark"></contact-component>
    <contact-component></contact-component>
    <contact-component variant="light"></contact-component>
  </b-list-group>
  </div>
</template>

<script>
export default {};
</script>