<template>
  <div ref="mapContainer" class="leaflet-map"></div>
</template>

<script setup lang="ts">
import 'leaflet/dist/leaflet.css';
import { onMounted, ref, watch } from 'vue';
import L from 'leaflet';

const props = defineProps<{ farms: Array<any> }>();
const mapContainer = ref<HTMLElement | null>(null);
let map: L.Map | null = null;
let markers: L.LayerGroup | null = null;

onMounted(() => {
  if (!mapContainer.value) return;
  map = L.map(mapContainer.value).setView([47.6588, -117.4260], 10); // Spokane default
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);
  markers = L.layerGroup().addTo(map);
  updateMarkers();
});

watch(() => props.farms, updateMarkers, { deep: true });

function updateMarkers() {
  if (!markers || !map) return;
  markers!.clearLayers();
  props.farms.forEach(farm => {
    const loc = farm.location;
    if (loc && loc.latitude && loc.longitude) {
      const marker = L.marker([loc.latitude, loc.longitude])
        .bindPopup(`<b>${farm.name}</b><br>${loc.label || ''}`);
      markers!.addLayer(marker);
    }
  });
}
</script>

<style scoped>
.leaflet-map {
  width: 100%;
  height: 100%;
}
</style> 