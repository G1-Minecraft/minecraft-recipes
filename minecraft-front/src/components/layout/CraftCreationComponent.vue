<script setup lang="ts">
import HomeMainComponent from "@/components/layout/HomeMainComponent.vue";
import ItemsListComponent from "@/components/elements/ItemsListComponent.vue";
import HomeAsideComponent from "@/components/layout/HomeAsideComponent.vue";
</script>

<template>
  <div class="craft">
    <HomeMainComponent />
    <HomeAsideComponent />
  </div>
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

.craft{
  display: flex;

}

</style>