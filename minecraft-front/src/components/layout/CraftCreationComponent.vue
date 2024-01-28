<script setup lang="ts">
import HomeMainComponent from "@/components/layout/HomeMainComponent.vue";
import ItemsListComponent from "@/components/layout/ItemsListComponent.vue";
</script>

<template>
  <h1>Création de craft</h1>
  <HomeMainComponent></HomeMainComponent>
  <ItemsListComponent></ItemsListComponent>
  <button type="submit" class="minecraftBtn">Envoyer</button>
</template>

<style scoped>

h1 {
  color: black;
  margin-left: auto;
  margin-right: auto;
}

button {
  width: 20%;
  margin-left: auto;
  margin-right: auto;
}

</style>