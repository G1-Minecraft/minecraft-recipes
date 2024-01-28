<script setup lang="ts">
  import HomeMainComponent from "@/components/layout/HomeMainComponent.vue";
  import ItemsListComponent from "@/components/layout/ItemsListComponent.vue";
</script>

<template>
    <div>
        <HomeMainComponent />
        <ItemsListComponent />
    </div>
</template>

<style scoped>
  div {
    display: flex;
    height: 100%;
    flex-direction: row;
  }
</style>

