
<template>
  <div class="flex flex-col min-h-screen">
    <AppHeader />
    <main class="flex-1 bg-background pb-12">
      <div class="max-w-3xl mx-auto py-10">
        <!-- Breadcrumbs -->
        <nav class="mb-6" aria-label="Breadcrumb">
          <ol class="flex items-center space-x-2 text-sm text-muted-foreground">
            <li>
              <a href="/farms" class="hover:underline text-green-700">Farms Map</a>
            </li>
            <li>
              <span class="mx-1">/</span>
            </li>
            <li class="text-foreground font-semibold truncate max-w-xs" style="max-width: 200px;">
              {{ farm.name }}
            </li>
          </ol>
        </nav>
        <!-- Sub Menu -->
        <nav class="mb-8" aria-label="Farm Sub Menu">
          <ul class="flex gap-6 border-b border-border pb-2">
            <li>
              <a href="#overview" class="text-sm font-medium text-foreground hover:text-green-700 focus:underline">Overview</a>
            </li>
            <li>
              <a href="#products" class="text-sm font-medium text-muted-foreground hover:text-green-700 focus:underline">Products</a>
            </li>
            <li>
              <a href="#gallery" class="text-sm font-medium text-muted-foreground hover:text-green-700 focus:underline">Gallery</a>
            </li>
            <li>
              <a href="#contact" class="text-sm font-medium text-muted-foreground hover:text-green-700 focus:underline">Contact</a>
            </li>
          </ul>
        </nav>
        <div class="flex items-center gap-6 mb-8">
          <img v-if="farm.logo_url" :src="farm.logo_url" alt="Farm Logo" class="w-24 h-24 object-cover border" style="border-radius: var(--radius-lg);" />
          <div>
            <h1 class="text-3xl font-bold mb-2">{{ farm.name }}</h1>
            <div class="text-gray-600">{{ farm.location?.label || farm.location?.address }}</div>
            <div class="text-gray-500 text-sm">{{ farm.location?.city }}, {{ farm.location?.state }}</div>
          </div>
        </div>
        <div class="mb-6">
          <p class="text-lg">{{ farm.description }}</p>
        </div>
        <div class="mb-4">
          <div v-if="farm.phone" class="mb-1"><strong>Phone:</strong> {{ farm.phone }}</div>
          <div v-if="farm.email" class="mb-1"><strong>Email:</strong> {{ farm.email }}</div>
          <div v-if="farm.website_url" class="mb-1">
            <strong>Website:</strong> <a :href="farm.website_url" target="_blank" class="text-blue-600 underline">{{ farm.website_url }}</a>
          </div>
        </div>
      </div>
    </main>
    <AppFooter />
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import AppHeader from '@/components/AppHeader.vue';
import AppFooter from '@/components/AppFooter.vue';
const props = defineProps<{ farm: any }>();
</script>
