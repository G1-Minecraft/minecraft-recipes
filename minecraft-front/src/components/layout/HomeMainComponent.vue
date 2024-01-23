<script setup lang="ts">
  import {type Ref, ref} from "vue";
  import type {CraftState} from "@/types";

  let state: Ref<CraftState> = ref({
    craftType: "CraftingTable",
    activeButton: "craftingTableButton",
  });


  function setCraftingTable() {
    state.value.craftType = "CraftingTable";
    updateActiveButton("craftingTableButton");
  }

  function setFurnace() {
    state.value.craftType = "Furnace";
    updateActiveButton("furnaceButton");
  }

  function setBrewingStand() {
    state.value.craftType = "BrewingStand";
    updateActiveButton("brewingStandButton");
  }

  function updateActiveButton(buttonId: string) {
    if (state.value.activeButton) {
      const prevButton = document.getElementById(state.value.activeButton) as HTMLButtonElement;
      if (prevButton) {
        prevButton.disabled = false;
      }
    }

    const currentButton = document.getElementById(buttonId) as HTMLButtonElement;
    if (currentButton) {
      currentButton.disabled = true;
      state.value.activeButton = buttonId;
    }
  }
</script>

<template>
  <main>
    <div class="table">
      <img v-if="state.craftType === 'CraftingTable'" class="craftingTable" src="@/assets/images/tables/GUI_Crafting_Table.png" alt="table de craft">
      <img v-else-if="state.craftType === 'Furnace'" class="furnace" src="@/assets/images/tables/GUI_Furnace.png" alt="four">
      <img v-else class="brewingStand" src="@/assets/images/tables/GUI_Brewing_Stand.png"  alt="alambique">
    </div>
    <div class="buttons">
      <button id="craftingTableButton" @click="setCraftingTable" :disabled="state.activeButton === 'craftingTableButton'">Crafting table</button>
      <button id="furnaceButton" @click="setFurnace" :disabled="state.activeButton === 'furnaceButton'">Furnace</button>
      <button id="brewingStandButton" @click="setBrewingStand" :disabled="state.activeButton === 'brewingStandButton'">Brewing Stand</button>
    </div>
  </main>
</template>

<style scoped>
  main {
    display: flex;
    height: 100%;
    width: 66%;
    justify-content: center;
    align-items: center;
  }

  .craftingTable {
    width: 75%;
  }

  .furnace {
    width: 75%;
  }

  .brewingStand {
    width: 50%;
  }

  .table {
    display: flex;
    justify-content: center;
    width: 100%;
    padding: 10% 10%;
  }
</style>