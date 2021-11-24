<template>
  <b-container  >
    <b-form class="m-2" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" v-model="csrfToken">
      <b-form-group label="Correo electrónico:">
        <b-form-input
          id="input-1"
          v-model="user.email"
          type="email"
          placeholder="Ingresa tu correo electrónico"
          required
          disabled
          name="email "
        ></b-form-input>
      </b-form-group>

      <b-form-group label="Nombre de usuario:" >
        <b-form-input          
          v-model="user.name"
          name="name"
          placeholder="Ingresa tu nomrbe de usuario"
        ></b-form-input>
      </b-form-group>
      <b-form-group label="Modificar contraseña:" >
        <b-form-input          
          placeholder="Ingresa tu nueva contraseña"
          name="password"
          type="password"
        ></b-form-input>
      </b-form-group>
      <b-form-group label="Imagen de perfil:" >
        <b-img :src="image" rounded="circle" width="60" height="60" alt="Imagen de perfil" title="Imagen actual" class="mt-1" />
        <b-form-file         
          name="image" 
          placeholder="Selecciona una foto de perfil"
        ></b-form-file>
      </b-form-group>

      <b-button type="submit" variant="primary">Guardar</b-button>
    </b-form>
  </b-container>
</template>

<script>
  export default {
    props:{
      user: {
        type: Object,
        required: true,
      },
      csrfToken: {
        type: String,
        required: true,
      },
    },
    data() {
      return {
      }
    },
    computed: {
      image() {
        return this.user.image ? `/users/${this.user.image}` : `/users/default.png`;
      },
    },
  }
</script>