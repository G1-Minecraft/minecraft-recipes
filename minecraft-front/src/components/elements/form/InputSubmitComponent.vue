<script setup lang="ts">
  const props = defineProps<{valueText: string}>();
</script>
<template>
  <div class="submitBtn">
    <input class="minecraftBtn" type="submit" v-model="props.valueText">
  </div>
</template>

<style scoped>
div {
  display: flex;
  justify-content: center;
}

 input {
   height: 30px;
 }

</style>