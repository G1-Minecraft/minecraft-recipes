<script setup lang="ts">
  import { onMounted, ref, computed, nextTick, watch } from 'vue';

  const items = ref([]);
  const itemsPerPage = ref(70);
  const currentPage = ref(1);
  const itemsPerLine = ref(10);
  const searchQuery = ref('');

  onMounted(() => {
    loadItems();
    nextTick(() => {
      updateItemsPerPage();
    });
  });

  function loadItems() {
    const imageContext = import.meta.glob('@/assets/images/items/*.png', { eager: true });
    items.value = Object.keys(imageContext).map((key) => ({ src: imageContext[key].default }));
  }

  const totalPages = computed(() => Math.ceil(items.value.length / itemsPerPage.value));

  const displayedItems = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return items.value.slice(start, end);
  });

  function nextPage() {
    if (currentPage.value < totalPages.value) {
      currentPage.value += 1;
    }
  }

  function prevPage() {
    if (currentPage.value > 1) {
      currentPage.value -= 1;
    }
  }

  function updateItemsPerPage() {
    const itemContainer = document.querySelector('.itemContainer');
    if (itemContainer) {
      const containerWidth = itemContainer.clientWidth;

      const itemWidth = 100 / itemsPerLine.value;
      const itemMargin = 10;

      itemsPerLine.value = Math.floor(containerWidth / (itemWidth + itemMargin));
      itemsPerPage.value = itemsPerLine.value * 2.5;
    }
  }

  watch(() => window.innerWidth, () => {
    updateItemsPerPage();
  });

  window.addEventListener('resize', () => {
    updateItemsPerPage();
  });

  watch(() => itemsPerLine.value, () => {
    updateItemsPerPage();
  });

  function filterItems() {
    const filteredItems = items.value.filter(item => item.src.toLowerCase().includes(searchQuery.value.toLowerCase()));
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    displayedItems.value = filteredItems.slice(start, end);
  }
</script>


<template>
  <div class="searchBar">
    <input class="minecraftBtn" v-model="searchQuery" @input="filterItems" type="text" />
  </div>
  <div>
    <div class="itemContainer">
      <div v-for="(item, index) in displayedItems" :key="index" class="item">
        <img :src="item.src" alt="Item" />
      </div>
    </div>
    <div class="pagination">
      <button class="minecraftBtn" @click="prevPage" :disabled="currentPage === 1">Prev</button>
      <span>{{ currentPage }}</span>
      <button class="minecraftBtn" @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<style scoped>
  .itemContainer {
    display: flex;
    flex-wrap: wrap;
    margin: 10px -5px 10px 2%;
  }

  .item {
    width: calc((100% / 10) - 20px);
    margin: 5px;
  }

  .pagination {
    margin-top: 10px;
    display: flex;
    justify-content: center;
  }
  span {
    margin: 0 2%;
  }

  button {
    margin: 0 5px;
    padding: 5px 10px;
  }

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