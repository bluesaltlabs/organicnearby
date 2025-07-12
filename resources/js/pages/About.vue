<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue';
import AppFooter from '@/components/AppFooter.vue';

</script>

<template>
<div class="flex flex-col min-h-screen">
  <AppHeader />
  <main class="flex-1 bg-background pb-12">
  <section class="max-w-5xl mx-auto px-4 py-16 text-center">
    <h1 class="text-3xl font-bold mb-4 text-primary">About Organic Nearby</h1>
    <p class="text-lg text-gray-700">This is a placeholder About page. More information coming soon.</p>
  </section>
  </main>
  <AppFooter />
</div>
</template>
