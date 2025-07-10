<template>
  <div class="flex h-screen">
    <aside class="w-80 bg-sidebar text-sidebar-foreground border-r border-sidebar-border p-4 overflow-y-auto flex flex-col gap-2">
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
    <main class="flex-1 h-screen">
      <FarmMap
        :farms="farms"
        :hoveredFarmId="hoveredFarmId"
        :selectedFarmId="selectedFarmId"
        @select-farm="selectedFarmId = $event"
      />
    </main>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import FarmMap from '../../components/FarmMap.vue';

const farms = ref<Array<{ id?: number; name?: string; location?: any }>>([]);
const hoveredFarmId = ref<number|null>(null);
const selectedFarmId = ref<number|null>(null);

onMounted(async () => {
  const res = await fetch('/api/farms');
  farms.value = await res.json();
});
</script> 