<script setup lang="ts">
import {ref, watch} from "vue";

  const searchQuery = ref('');

  watch(() => searchQuery.value, () => {
    filteredItems.value = items.value.filter((item) =>
        item.src.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  });
</script>

<template>
  <div class="searchBar">
    <input class="minecraftBtn" v-model="searchQuery" type="text">
  </div>
</template>

<style scoped>

input {
  width: 90%;
  height: 50%;
}

.searchBar {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 15%;
}
</style>