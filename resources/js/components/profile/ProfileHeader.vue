<script setup lang="ts">
defineProps<{ user: any }>();
</script>
<template>
  <div class="bg-accent dark:bg-muted rounded-lg p-6 flex flex-col items-center relative">
    <div class="absolute inset-x-0 top-0 h-24 bg-repeat-x bg-[url('/pattern.svg')] rounded-t-lg opacity-80 dark:opacity-40"></div>
    <div class="relative z-10 flex flex-col items-center">
      <div class="w-24 h-24 rounded-full bg-card shadow -mt-12 flex items-center justify-center overflow-hidden">
        <img v-if="user.avatar" :src="user.avatar" :alt="user.name" class="w-full h-full object-cover rounded-full" />
        <span v-else class="text-4xl">🌽</span>
      </div>
      <h2 class="mt-4 text-2xl font-bold text-foreground">{{ user.name }}</h2>
      <p class="text-muted-foreground">{{ user.location || 'Location not set' }}</p>
      <button class="mt-2 px-4 py-2 bg-card border border-green-600 text-green-700 dark:text-green-300 rounded-lg font-semibold hover:bg-accent transition">Edit Profile</button>
    </div>
  </div>
</template> 