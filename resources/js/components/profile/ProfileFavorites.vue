<script setup lang="ts">
defineProps<{ user: any }>();
</script>
<template>
  <div class="bg-card rounded-lg shadow p-6">
    <h3 class="font-semibold mb-2 text-foreground">My favorite products</h3>
    <div v-if="user.favorites && user.favorites.length">
      <ul class="space-y-1">
        <li v-for="product in user.favorites" :key="product.id">{{ product.name }}</li>
      </ul>
    </div>
    <div v-else class="text-muted-foreground">Go follow some farms!</div>
  </div>
</template> 