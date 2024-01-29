<script setup lang="ts">
  import { ref } from 'vue';
  import { useRouter } from 'vue-router'
  import {storeAuthentification} from "@/store/storeAuthentification";
  import * as CryptoJS from 'crypto-js';

  const router = useRouter()

  function logout() {
    storeAuthentification.deconnexion();
    router.push({name: 'home'});
  }

  function encodeMD5(message: string): string {
    const hash = CryptoJS.MD5(message);
    return hash.toString();
  }

  const url = ref("http://localhost:8230/avatar/" + encodeMD5(storeAuthentification.data.email));
</script>

<template>
  <header>
    <nav>
      <div class="imgAccueil">
        <img src="@/assets/images/minecraft-crafting-table.png" alt="logo" @click="router.push({name: 'home'})" />
      </div>
      <div class="infos">
        <div v-if="storeAuthentification.estConnecte" class="text" @click="router.push({name: 'items'})">Créer un item</div>
        <div v-if="storeAuthentification.estConnecte" class="text" @click="router.push({name: 'crafts'})">Créer un craft</div>
        <div v-if="!storeAuthentification.estConnecte" class="text" @click="router.push({name: 'connexion'})">Connexion</div>
        <div v-if="!storeAuthentification.estConnecte" class="text" @click="router.push({name: 'register'})">Inscription</div>
        <div v-if="storeAuthentification.estConnecte">
            <img :src="url" alt="Photo de profil de l'utilisateur">
        </div>
        <div v-if="storeAuthentification.estConnecte" class="text" @click="logout()">Deconnexion</div>
      </div>
    </nav>
  </header>
</template>

<style scoped>
header{
  display: flex;
  background-image: url("@/assets/images/background/header-background.svg");
  height: 80px;
  flex-shrink: 0;
}

nav {
  display: flex;
  flex-direction: row;
  width: 100%;
  justify-content: space-evenly;
}

img{
  width: 50px;
  flex-shrink: 0;
  cursor: pointer;
}

.imgAccueil {
  display: flex;
  align-items: center;
  padding-left: 2%;
  width: 10%;
}

.infos {
  display: flex;
  flex-direction: row;
  align-items: center;
  width: 90%;
}

.infos div {
  margin-right: 20px;
  cursor: pointer;
}

.infos div:hover {
  color: yellow;
}

.text{
  color: #FFF;
  font-family: NotoSans,serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

</style>