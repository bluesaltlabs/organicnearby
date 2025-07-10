<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Edit Farm</h1>
    <form @submit.prevent="submit">
      <div class="mb-2">
        <label class="block">Name</label>
        <input v-model="form.name" class="border p-2 w-full" required />
      </div>
      <div class="mb-2">
        <label class="block">Slug</label>
        <input v-model="form.slug" class="border p-2 w-full" required />
      </div>
      <div class="mb-2">
        <label class="block">Description</label>
        <textarea v-model="form.description" class="border p-2 w-full" />
      </div>
      <div class="mb-2">
        <label class="block">Phone</label>
        <input v-model="form.phone" class="border p-2 w-full" />
      </div>
      <div class="mb-2">
        <label class="block">Email</label>
        <input v-model="form.email" type="email" class="border p-2 w-full" />
      </div>
      <div class="mb-2">
        <label class="block">Logo URL</label>
        <input v-model="form.logo_url" class="border p-2 w-full" />
      </div>
      <div class="mb-2">
        <label class="block">Website URL</label>
        <input v-model="form.website_url" class="border p-2 w-full" />
      </div>
      <div class="mb-2">
        <label class="block">Approved</label>
        <input type="checkbox" v-model="form.is_approved" />
      </div>
      <LocationEditForm v-model:location="form.location" />
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import type { Farm } from '@/types/farm';
import { blankLocation } from '@/types/location';
import LocationEditForm from '@/components/LocationEditForm.vue';

const farm = usePage().props.farm as Farm;

const form = reactive({
  ...farm,
  location: farm.location ? { ...farm.location } : blankLocation(),
});

function submit() {
  router.patch(`/farms/${farm.id}`, form);
}
</script> 