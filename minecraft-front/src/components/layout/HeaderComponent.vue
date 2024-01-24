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
        <div class="textMinecraftWebUI" @click="router.push({name: 'connexion'})">Connexion</div>
        <div class="textMinecraftWebUI" @click="router.push({name: 'register'})">Inscription</div>
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
</style>