<script setup lang="ts">
import { useRouter } from 'vue-router'
const router = useRouter()
</script>
<template>
<header>
  <nav class="menu">
    <div class="imgAccueil"><img src="@/assets/images/minecraft-crafting-table.png" alt="logo" @click="router.push({name: 'home'})" /></div>
    <div class="textConnexion" @click="router.push({name: 'connexion'})">Connexion</div>
    <div class="textRegister" @click="router.push({name: 'register'})">Inscription</div>
  </nav>
</header>
</template>

<style scoped>
header{
  background-image: url("@/assets/images/background/header-background.svg");
  height: 100px;
  flex-shrink: 0;
}

nav{
  display: flex;
  height: 100px;
  justify-content: flex-end;
  align-items: flex-start;
  gap: 41px;
  flex-shrink: 0;
}

img{
  width: 50px;
  flex-shrink: 0;
}

.imgAccueil{
  padding: 20px 75% 0 0;
}

.textConnexion{
  padding: 30px 0 0 0;
  color: #FFF;
  font-family: NotoSans,serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

.textRegister{
  padding: 30px 30px 0 0;
  color: #FFF;
  font-family: NotoSans,serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 400;
  line-height: normal;
}

</style>