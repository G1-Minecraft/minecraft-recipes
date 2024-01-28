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
    <form @submit.prevent="connect" class="formConnexionContent">
      <div class="inputsFormConnexion">
        <div class="group">
          <label class="textMinecraftWebUI" for="name">Nom d'utilisateur</label>
          <InputTextComponent v-model="registerUser.login" name="name" id="name" required />
        </div>
        <div>
          <label class="textMinecraftWebUI" for="email">Email</label>
          <InputTextComponent v-model="registerUser.email" name="email" id="email" required />
        </div>
        <div class="group">
          <label class="textMinecraftWebUI" for="password">Mot de passe</label>
          <InputPasswordComponent v-model="registerUser.password" name="password" id="password" required />
        </div>
        <div class="group">
          <label class="textMinecraftWebUI" for="password">Confirmer le mot de passe</label>
          <InputPasswordComponent v-model="registerUser.password" name="password" id="password" required />
        </div>
      </div>
      <div class="submitInputButtonConnexion">
        <InputSubmitComponent :value-text="connexionTest" />
      </div>
    </form>
  </main>
</template>

<style scoped>
main{
  background-image: url("@/assets/images/background/form-register-background.svg");

}
</style>