
<template>
  <div class="flex flex-col min-h-screen">
    <AppHeader />
    <main class="flex-1 flex flex-col md:flex-row bg-background gap-4 px-2 md:px-8 py-4">
      <aside class="w-full md:w-80 bg-sidebar text-sidebar-foreground border md:border-r border-sidebar-border p-4 overflow-y-auto flex flex-col gap-2 md:sticky md:top-[72px] md:h-[calc(100vh-120px)] max-h-[60vh] md:max-h-[calc(100vh-120px)] rounded-lg md:rounded-none mb-4 md:mb-0">
        <h2 class="text-lg font-semibold mb-4 px-2">Farms</h2>
        <ul class="flex flex-col gap-2">
          <li
            v-for="farm in farms"
            :key="farm.id"
            class="group rounded-lg border border-transparent px-3 py-2 transition-colors cursor-pointer hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
            :class="{
              'bg-blue-100 border-blue-200': hoveredFarmId === (farm.id ?? null),
              'ring-2 ring-primary border-primary': selectedFarmId === (farm.id ?? null)
            }"
            @mouseenter="hoveredFarmId = farm.id ?? null"
            @mouseleave="hoveredFarmId = null"
            @click="selectedFarmId = farm.id ?? null"
          >
            <div class="font-medium text-base truncate">{{ farm.name }}</div>
            <div v-if="farm.location" class="text-muted-foreground text-sm truncate">
              {{ farm.location.label || farm.location.address }}<br>
              <span class="text-xs">{{ farm.location.city }}, {{ farm.location.state }}</span>
            </div>
          </li>
        </ul>
      </aside>
      <section class="flex-1 min-h-[300px] md:min-h-[500px] rounded-lg overflow-hidden relative" style="background: #f6f6f6;">
        <div class="absolute inset-0 p-2 md:p-4">
          <FarmMap
            :farms="farms"
            :hoveredFarmId="hoveredFarmId"
            :selectedFarmId="selectedFarmId"
            @select-farm="selectedFarmId = $event"
          />
        </div>
      </section>
    </main>
    <footer class="mt-auto"><AppFooter /></footer>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import FarmMap from '../../components/FarmMap.vue';
import AppHeader from '@/components/AppHeader.vue';
import AppFooter from '@/components/AppFooter.vue';

const farms = ref<Array<{ id?: number; name?: string; location?: any }>>([]);
const hoveredFarmId = ref<number|null>(null);
const selectedFarmId = ref<number|null>(null);

onMounted(async () => {
  const res = await fetch('/api/farms');
  farms.value = await res.json();
});
</script>
