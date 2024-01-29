<script setup lang="ts">

import InputTextComponent from "@/components/elements/form/InputTextComponent.vue";
import InputSubmitComponent from "@/components/elements/form/InputSubmitComponent.vue";
import InputPasswordComponent from "@/components/elements/form/InputPasswordComponent.vue";

import {ref} from 'vue';
import {storeAuthentification} from "@/store/storeAuthentification";
import router from "@/router";
const registerUser = ref({
  login: '',
  password: '',
  passwordConfirm: '',
  email: ''
});


function register(): void{
  if (!checkPassword()){
    alert("Les mots de passe ne sont pas identiques");
    return;
  }
  else{
    storeAuthentification.inscription(registerUser.value.login, registerUser.value.password, registerUser.value.email,
        () => { router.push('/connexion') },
        () => {
          registerUser.value.login = "";
          registerUser.value.password = "";
          registerUser.value.email = "";
        },
    );
  }
}

function checkPassword(): boolean{
  return registerUser.value.password === registerUser.value.passwordConfirm;
}

const connexionTest = 'Inscription'
</script>


<template>
  <main>
    <form @submit.prevent="register">
      <div class="inputs">
        <div class="group">
          <label for="name">Nom d'utilisateur</label>
          <div class="inputBar">
            <input class="minecraftBtn" v-model="registerUser.login" type="text" name="name" id="name" required>
          </div>
        </div>
        <div>
          <label for="email">Email</label>
          <div class="inputBar">
            <input class="minecraftBtn" v-model="registerUser.email" type="text" name="email" id="mail">
          </div>
        </div>
        <div class="group">
          <label for="password">Mot de passe</label>
          <div class="inputBar">
            <input class="minecraftBtn" v-model="registerUser.password" type="password" name="password" id="password" required>
          </div>
        </div>
        <div class="group">
          <label for="passwordConfirm">Confirmer le mot de passe</label>
          <div class="inputBar">
            <input class="minecraftBtn" v-model="registerUser.passwordConfirm" type="password" name="passwordConfirm" id="passwordConfirm" required>
          </div>
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

  input {
    height: 25px;
    color: white;
  }
</style>