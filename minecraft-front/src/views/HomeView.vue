<script setup lang="ts">
  import HomeMainComponent from "@/components/layout/HomeMainComponent.vue";
  import ItemsListComponent from "@/components/elements/ItemsListComponent.vue";
  import HomeAsideComponent from "@/components/layout/HomeAsideComponent.vue";
</script>

<template>
    <div>
        <HomeMainComponent />
        <HomeAsideComponent />
    </div>
</template>

<style scoped>
  div {
    display: flex;
    height: 100%;
    flex-direction: row;
  }
</style>

