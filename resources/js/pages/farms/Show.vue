<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import type { Farm } from '@/types/farm';

const farm = usePage().props.farm as Farm;
</script>

<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">{{ farm.name }}</h1>
    <div class="mb-4">
      <img v-if="farm.logo_url" :src="farm.logo_url" alt="Logo" class="h-24 mb-2" />
      <p><strong>Slug:</strong> {{ farm.slug }}</p>
      <p><strong>Description:</strong> {{ farm.description }}</p>
      <p><strong>Phone:</strong> {{ farm.phone }}</p>
      <p><strong>Email:</strong> {{ farm.email }}</p>
      <p><strong>Approved:</strong> {{ farm.is_approved ? 'Yes' : 'No' }}</p>
      <p v-if="farm.website_url"><strong>Website:</strong> <a :href="farm.website_url" target="_blank" class="text-blue-600 underline">Visit</a></p>
      <p><strong>Created:</strong> {{ farm.created_at }}</p>
      <p><strong>Updated:</strong> {{ farm.updated_at }}</p>
    </div>
    <router-link to="/farms" class="text-blue-600 underline">Back to list</router-link>
  </div>
</template>
