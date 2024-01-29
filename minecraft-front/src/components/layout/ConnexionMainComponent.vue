<script setup lang="ts">
  import InputSubmitComponent from "@/components/elements/form/InputSubmitComponent.vue";

  import {ref} from 'vue';
  import {storeAuthentification} from "@/store/storeAuthentification";
  import router from "@/router";
  const connectingUser = ref({
    login: '',
    password: ''
  });
  async function connect(): Promise<void>{
    await storeAuthentification.connexion(connectingUser.value.login, connectingUser.value.password,
        () => { router.push('/') },
        () => {
          connectingUser.value.login = "";
          connectingUser.value.password = "";
        },
    );
  }

  const connexionTest = 'Connexion'
</script>

<template>
  <main>
    <form @submit.prevent="connect">
      <div class="inputs">
        <div class="group">
          <label for="name">Nom d'utilisateur</label>
          <div class="inputBar">
            <input class="minecraftBtn" v-model="connectingUser.login" type="text" name="name" id="name" required>
          </div>
        </div>
        <div class="group">
          <label for="password">Mot de passe</label>
          <div class="inputBar">
            <input class="minecraftBtn" v-model="connectingUser.password" type="password" name="password" id="password" required>
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
  height: 40%;
  padding: 2%;
}

.inputs{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 50%;
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