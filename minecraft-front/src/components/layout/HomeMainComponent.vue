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
      <div v-if="state.craftType === 'CraftingTable'">
        <img class="craftingTable" src="@/assets/images/tables/GUI_Crafting_Table.png" alt="table de craft">
        <table class="input">
          <tr>
            <td id="1">Case1</td>
            <td id="2">Case2</td>
            <td id="3">Case3</td>
          </tr>
          <tr>
            <td id="4">Case4</td>
            <td id="5">Case5</td>
            <td id="6">Case6</td>
          </tr>
          <tr>
            <td id="7">Case7</td>
            <td id="8">Case8</td>
            <td id="9">Case9</td>
          </tr>
        </table>
        <table class="output">
          <tr>
            <td>Sortie</td>
          </tr>
        </table>
      </div>
      <img v-else-if="state.craftType === 'Furnace'" class="furnace" src="@/assets/images/tables/GUI_Furnace.png" alt="four">
      <img v-else class="brewingStand" src="@/assets/images/tables/GUI_Brewing_Stand.png"  alt="alambique">
    </div>
    <div class="buttons">
      <button class="minecraftBtn" id="craftingTableButton" @click="setCraftingTable" :disabled="state.activeButton === 'craftingTableButton'">Table de craft</button>
      <button class="minecraftBtn" id="furnaceButton" @click="setFurnace" :disabled="state.activeButton === 'furnaceButton'">Four</button>
      <button class="minecraftBtn" id="brewingStandButton" @click="setBrewingStand" :disabled="state.activeButton === 'brewingStandButton'">Alambic</button>
    </div>
  </main>
</template>

<style scoped>
  main {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 66%;
    justify-content: space-evenly;
    align-items: center;
  }

  td {
    text-align: center;
    height: 25%;
    color: rgba(0, 0, 0, 0);
  }

  .input, .output {
    position: absolute;
    top: 8.5%; left: 9%;
    width: 38%;
    height: 80%;
  }

  .output {
    left: 73%;
    top: 32%;
    height: 35%;
    width: 17%;
  }

  .table > div {
    display: flex;
    position: relative;
    width: inherit;
    justify-content: center;
  }

  .craftingTable {
    width: 90%;
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
    padding: 5% 10%;
  }

  .buttons {
    display: flex;
    justify-content: space-evenly;
    width: 100%;
    padding: 2% 0;
  }

</style>