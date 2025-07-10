<template>
  <div class="flex h-screen">
    <aside class="w-80 bg-slate-50 border-r border-slate-200 p-4 overflow-y-auto">
      <h2 class="text-lg font-semibold mb-4">Farms</h2>
      <ul>
        <li v-for="farm in farms" :key="farm.id" class="mb-6 pb-4 border-b border-slate-200 last:border-b-0 last:pb-0 last:mb-0">
          <div class="font-bold text-base">{{ farm.name }}</div>
          <div v-if="farm.location" class="text-slate-500 text-sm">
            {{ farm.location.label || farm.location.address }}<br>
            <small>{{ farm.location.city }}, {{ farm.location.state }}</small>
          </div>
        </li>
      </ul>
    </aside>
    <main class="flex-1 h-screen">
      <FarmMap :farms="farms" />
    </main>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import FarmMap from '../../components/FarmMap.vue';

const farms = ref<Array<{ id?: number; name?: string; location?: any }>>([]);

onMounted(async () => {
  const res = await fetch('/api/farms');
  farms.value = await res.json();
});
</script>

<!-- No custom styles needed, all handled by Tailwind --> 