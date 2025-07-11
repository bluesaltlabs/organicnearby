<script setup lang="ts">
defineProps<{ user: any }>();
</script>
<template>
  <div class="bg-card rounded-lg shadow p-6">
    <h3 class="font-semibold mb-2 text-foreground">Farms I follow</h3>
    <div v-if="user.farms && user.farms.length">
      <ul class="space-y-1">
        <li v-for="farm in user.farms" :key="farm.id">{{ farm.name }}</li>
      </ul>
    </div>
    <div v-else class="text-muted-foreground">Go follow some farms!</div>
  </div>
</template> 