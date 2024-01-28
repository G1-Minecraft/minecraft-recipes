<script setup lang="ts">
  const props = defineProps<{valueText: string}>();
</script>
<template>
  <div class="submitBtn">
    <input class="textMinecraftFigmaUI" type="submit" v-model="props.valueText">
  </div>
</template>