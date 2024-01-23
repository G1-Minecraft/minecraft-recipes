<script setup lang="ts">
  import HomeMainComponent from "@/components/layout/HomeMainComponent.vue";
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
    flex-direction: row;
  }
</style>

