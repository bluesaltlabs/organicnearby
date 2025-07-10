<template>
  <div class="mb-4">
    <h2 class="text-lg font-semibold mb-2">Location</h2>
    <div v-for="field in editableFields" :key="field" class="mb-2">
      <label class="block">{{ toLabel(field) }}</label>
      <input
        v-model="modelValue[field]"
        :type="isNumberField(field) ? 'number' : 'text'"
        :step="isNumberField(field) ? 'any' : undefined"
        class="border p-2 w-full"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { blankLocation } from '@/types/location';

const props = defineProps({
  location: {
    type: Object,
    required: true,
    default: () => blankLocation()
  }
});
const emit = defineEmits(['update:location']);

const editableFields = Object.keys(blankLocation());
const isNumberField = (field: string) => ['latitude', 'longitude'].includes(field);
const toLabel = (field: string) => field.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

const modelValue = computed({
  get: () => props.location,
  set: (val) => emit('update:location', val)
});
</script>
