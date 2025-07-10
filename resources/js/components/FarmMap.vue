<template>
  <div ref="mapContainer" class="leaflet-map"></div>
</template>

<script setup lang="ts">
import 'leaflet/dist/leaflet.css';
import { onMounted, ref, watch, defineEmits } from 'vue';
import L from 'leaflet';

const emit = defineEmits(['select-farm']);

const props = defineProps<{
  farms: Array<any>,
  hoveredFarmId?: number | null,
  selectedFarmId?: number | null
}>();
const mapContainer = ref<HTMLElement | null>(null);
let map: L.Map | null = null;
let markers: L.LayerGroup | null = null;
const markerRefs: Record<number, L.Marker> = {};

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
watch(() => props.hoveredFarmId, updateMarkerHighlight);
watch(() => props.selectedFarmId, openSelectedPopup);

function updateMarkers() {
  if (!markers || !map) return;
  markers!.clearLayers();
  Object.keys(markerRefs).forEach(k => delete markerRefs[Number(k)]);
  props.farms.forEach(farm => {
    const loc = farm.location;
    if (loc && loc.latitude && loc.longitude && farm.id != null) {
      const marker = L.marker([loc.latitude, loc.longitude], {
        icon: getMarkerIcon(farm.id === props.hoveredFarmId)
      })
        .bindPopup(`<b>${farm.name}</b><br>${loc.label || ''}`);
      marker.on('click', () => emit('select-farm', farm.id));
      markerRefs[farm.id] = marker;
      markers!.addLayer(marker);
    }
  });
}

function updateMarkerHighlight() {
  if (!markers) return;
  Object.entries(markerRefs).forEach(([id, marker]) => {
    marker.setIcon(getMarkerIcon(Number(id) === props.hoveredFarmId));
  });
}

function openSelectedPopup() {
  if (!map || !props.selectedFarmId) return;
  const marker = markerRefs[props.selectedFarmId];
  if (marker) {
    marker.openPopup();
    map.setView(marker.getLatLng(), map.getZoom(), { animate: true });
  }
}

function getMarkerIcon(highlighted: boolean) {
  return L.icon({
    iconUrl: highlighted
      ? 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png'
      : 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    shadowSize: [41, 41]
  });
}
</script>

<style scoped>
.leaflet-map {
  width: 100%;
  height: 100%;
}
</style> 