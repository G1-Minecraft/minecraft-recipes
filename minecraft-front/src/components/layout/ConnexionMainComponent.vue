<script setup lang="ts">
  import InputTextComponent from "@/components/elements/form/InputTextComponent.vue";
  import InputPasswordComponent from "@/components/elements/form/InputPasswordComponent.vue";
  import InputSubmitComponent from "@/components/elements/form/InputSubmitComponent.vue";

  import {ref} from 'vue';
  const connectingUser = ref({
    login: '',
    password: ''
  });
  function connect():void{
    console.log(connectingUser.value);
  }

  const connexionTest = 'Connexion'
</script>

<template>
  <main>
    <form @submit.prevent="connect" class="formConnexionContent">
      <div class="inputsFormConnexion">
        <div class="group">
          <label class="textMinecraftWebUI" for="name">Nom d'utilisateur</label>
          <InputTextComponent v-model="connectingUser.login" name="name" id="name" required />
        </div>
        <div class="group">
          <label class="textMinecraftWebUI" for="password">Mot de passe</label>
          <InputPasswordComponent v-model="connectingUser.password" name="password" id="password" required />
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
  background-image: url("@/assets/images/background/form-connexion-background.svg");
  width: 20%;
  flex-shrink: 0;
}


</style>