<script setup lang="ts">
  import ItemsListComponent from "@/components/elements/ItemsListComponent.vue";
</script>

<template>
  <aside>
    <ItemsListComponent />
  </aside>
</template>

<style scoped>
  aside {
    display: flex;
    flex-direction: column;
    width: 34%;
    background: rgba(0, 0, 0, 0.75);
  }
</style>