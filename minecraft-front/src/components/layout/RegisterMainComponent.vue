<script setup lang="ts">

import InputTextComponent from "@/components/elements/form/InputTextComponent.vue";
import InputSubmitComponent from "@/components/elements/form/InputSubmitComponent.vue";
import InputPasswordComponent from "@/components/elements/form/InputPasswordComponent.vue";

import {ref} from 'vue';
const registerUser = ref({
  login: '',
  password: '',
  email: ''
});
function connect():void{
  console.log(registerUser.value);
}

const connexionTest = 'Inscription'
</script>


<template>
  <main>
    <form @submit.prevent="connect">
      <div class="inputs">
        <div class="group">
          <label for="name">Nom d'utilisateur</label>
          <InputTextComponent v-model="registerUser.login" name="name" id="name" required />
        </div>
        <div>
          <label for="email">Email</label>
          <InputTextComponent v-model="registerUser.email" name="email" id="email" required />
        </div>
        <div class="group">
          <label for="password">Mot de passe</label>
          <InputPasswordComponent v-model="registerUser.password" name="password" id="password" required />
        </div>
        <div class="group">
          <label for="password">Confirmer le mot de passe</label>
          <InputPasswordComponent v-model="registerUser.password" name="password" id="password" required />
        </div>
      </div>
      <div>
        <InputSubmitComponent :value-text="connexionTest" />
      </div>
    </form>
  </main>
</template>


<style scoped>

  form {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
  }

  main{
    background-image: url("@/assets/images/background/form-connexion-background.svg");
    width: 25%;
    height: 80%;
    padding: 2%;
  }

  .inputs{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 60%;
  }

  .inputBar {
    display: flex;
    flex-direction: column;
    width: 70%;
  }
</style>