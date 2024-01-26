<script setup lang="ts">
  import {onMounted, ref, computed, watch, type Ref} from 'vue';
  import type {Item} from "@/types";

  const items: Ref<Item[]>  = ref([]);
  const itemsPerPage = ref(70);
  const currentPage = ref(1);
  const itemsPerLine = ref(10);
  const searchQuery = ref('');

  onMounted(() => {
    fetch("http://localhost:8210/api/items?page=1")
      .then(reponsehttp => reponsehttp.json())
      .then(reponseJSON => {
        items.value = reponseJSON["hydra:member"];
      });
  })

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

  function placeItemInTable(item: Item) {
    const casesInput = document.querySelectorAll('.input td');
    const casesOutput = document.querySelectorAll('.output td');

    const balise = `
            <div :key="${item.name}" class="item">
                <img style="width: 70%" src="/src/assets/images/items/${item.textureName}.png" alt="Item" />
            </div>
        `;

    casesInput.forEach((caseElement) => {
      caseElement.addEventListener('click', () => {
        caseElement.innerHTML = balise;
      });
    });

    casesOutput.forEach((caseElement) => {
      caseElement.addEventListener('click', () => {
        caseElement.innerHTML = balise;
      });
    });
  }
</script>


<template>
  <div class="searchBar">
    <input class="minecraftBtn" v-model="searchQuery" @input="filterItems" type="text" />
  </div>
  <div>
    <div class="itemContainer">
      <div v-for="item in displayedItems" :key="item.name" class="item" @click="placeItemInTable(item, 1, 1)">
        <img :src="'/src/assets/images/items/'+ item.textureName + '.png'" alt="Item" />
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