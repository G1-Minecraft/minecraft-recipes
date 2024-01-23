<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import HeaderComponent from '@/components/layout/HeaderComponent.vue'
import FooterComponent from "@/components/layout/FooterComponent.vue";
</script>

<template>
  <HeaderComponent />
  <RouterView />
  <FooterComponent />
</template>

<style>
  @font-face {
    font-family: "NotoSans";
    src: url("@/assets/fonts/NotoSans-Regular.ttf");
  }
</style>