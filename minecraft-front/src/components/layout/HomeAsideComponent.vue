<script setup lang="ts">
  import ItemsListComponent from "@/components/elements/ItemsListComponent.vue";
  import SearchBarComponent from "@/components/elements/SearchBarComponent.vue";
</script>

<template>
  <aside>
    <ItemsListComponent />
    <SearchBarComponent />
  </aside>
</template>

<style scoped>
  aside {
    display: flex;
    flex-direction: column-reverse;
    width: 34%;
    border: 1px solid #000;
    background: rgba(0, 0, 0, 0.75);
  }
</style>