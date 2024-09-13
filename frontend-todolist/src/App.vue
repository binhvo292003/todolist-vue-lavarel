<template>
  <div id="app">
    <AppNavigation />
    <router-view />
    <AppFooter />

  </div>
</template>

<script setup>
import AppNavigation from '@/components/AppNavigation.vue';
import AppFooter from '@/components/AppFooter.vue';
</script>
