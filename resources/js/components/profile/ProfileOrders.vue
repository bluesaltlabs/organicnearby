<script setup lang="ts">
defineProps<{ user: any }>();
</script>
<template>
  <div class="bg-card rounded-lg shadow p-6">
    <h3 class="font-semibold mb-2 text-foreground">Order history</h3>
    <div v-if="user.orders && user.orders.length">
      <ul class="space-y-1">
        <li v-for="order in user.orders" :key="order.id">Order #{{ order.id }} - {{ order.status }}</li>
      </ul>
    </div>
    <div v-else class="text-muted-foreground">Online ordering coming soon...</div>
  </div>
</template> 