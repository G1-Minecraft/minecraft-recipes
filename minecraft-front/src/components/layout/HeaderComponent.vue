<script setup lang="ts">
  import { ref } from 'vue';
  import { useRouter } from 'vue-router'
  import {storeAuthentification} from "@/store/storeAuthentification";

  const router = useRouter()

  function logout() {
    storeAuthentification.deconnexion();
    router.push({name: 'home'});
  }

  function test(){
    console.log(storeAuthentification.data.email)
  }

  const url2 = ref("https://i.pinimg.com/736x/e5/fc/d2/e5fcd217ee9df4e5b4895578e59407a3.jpg");
  //const url = ref("https://webinfo.iutmontp.univ-montp2.fr/~jalbaudl/minecraft-avatar/avatar/" + md5(storeAuthentification.data.email) + ".png");
</script>

<template>
  <header>
    <nav>
      <div class="imgAccueil">
        <img src="@/assets/images/minecraft-crafting-table.png" alt="logo" @click="router.push({name: 'home'})" />
      </div>
      <div class="infos">
        <div v-if="!storeAuthentification.estConnecte" class="text" @click="router.push({name: 'connexion'})">Connexion</div>
        <div v-if="!storeAuthentification.estConnecte" class="text" @click="router.push({name: 'register'})">Inscription</div>
        <div class="text" @click="test()">Test</div>
        <div v-if="storeAuthentification.estConnecte">
            <img :src="url2" alt="Photo de profil de l'utilisateur">
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
  justify-content: space-between;
}

img{
  width: 50px;
  flex-shrink: 0;
}

.imgAccueil {
  display: flex;
  align-items: center;
  padding-left: 2%;
}

.infos {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
  align-items: center;
  width: 20%;
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