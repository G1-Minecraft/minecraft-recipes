<script setup lang="ts">
  import { useRouter } from 'vue-router'
  const router = useRouter()
</script>

<template>
  <header>
    <nav>
      <div class="imgAccueil">
        <img src="@/assets/images/minecraft-crafting-table.png" alt="logo" @click="router.push({name: 'home'})" />
      </div>
      <div class="infos">
        <div class="text" @click="router.push({name: 'items'})">Créer un item</div>
        <div class="text" @click="router.push({name: 'crafts'})">Créer un craft</div>
        <div class="text" @click="router.push({name: 'connexion'})">Connexion</div>
        <div class="text" @click="router.push({name: 'register'})">Inscription</div>
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