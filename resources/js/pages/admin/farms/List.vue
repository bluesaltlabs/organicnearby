<script setup lang="ts">
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import type { Farm } from '@/types/farm';
import type { BreadcrumbItemType } from '@/types';
import { Checkbox } from '@/components/ui/checkbox';

interface PaginationLink {
  url: string | null;
  label: string;
  active: boolean;
}

interface PaginatedFarms {
  data: Farm[];
  links: PaginationLink[];
}

const farms = usePage().props.farms as PaginatedFarms;

const breadcrumbs: BreadcrumbItemType[] = [
  { title: 'Farms', href: '/admin/farms' }
];

function goTo(url: string) {
  if (url && url.length > 0) router.visit(url);
}
</script>

<template>
  <AppSidebarLayout :breadcrumbs="breadcrumbs">
    <h1 class="text-2xl font-bold mb-4 text-foreground">Farms</h1>
    <div class="overflow-x-auto rounded-xl border border-border bg-background shadow-sm">
      <table class="min-w-full divide-y divide-border bg-background text-foreground">
        <thead>
          <tr>
            <th class="px-4 py-2 text-left font-semibold text-muted-foreground">Name</th>
            <th class="px-4 py-2 text-left font-semibold text-muted-foreground">Approved</th>
            <th class="px-4 py-2 text-left font-semibold text-muted-foreground">Website</th>
            <th class="px-4 py-2 text-left font-semibold text-muted-foreground">Created</th>
            <th class="px-4 py-2 text-left font-semibold text-muted-foreground">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="farm in farms.data" :key="farm.id" class="odd:bg-muted even:bg-background hover:bg-accent/40 transition-colors">
            <td class="px-4 py-2 border-b border-border">{{ farm.name }}</td>
            <td class="px-4 py-2 border-b border-border">{{ farm.is_approved ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2 border-b border-border">
              <a v-if="farm.website_url" :href="farm.website_url" target="_blank" class="text-blue-600 underline dark:text-blue-400">Visit</a>
            </td>
            <td class="px-4 py-2 border-b border-border">{{ farm.created_at }}</td>
            <td class="px-4 py-2 border-b border-border whitespace-nowrap">
              <button
                class="inline-flex items-center px-2 py-1 mr-2 text-xs font-medium text-blue-700 bg-blue-100 rounded hover:bg-blue-200"
                @click="router.visit(`/admin/farms/${farm.id}`)"
                title="View"
              >View</button>
              <button
                class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded hover:bg-green-200"
                @click="router.visit(`/admin/farms/${farm.id}/edit`)"
                title="Edit"
              >Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="farms.links && farms.links.length > 1" class="mt-4 flex gap-2">
      <button
        v-for="link in farms.links"
        :key="link.url ?? link.label"
        :disabled="!link.url"
        @click="goTo(link.url ?? '')"
        class="px-3 py-1 border rounded border-border bg-background text-foreground hover:bg-accent hover:text-accent-foreground disabled:bg-muted disabled:text-muted-foreground"
        :class="{ 'bg-primary text-primary-foreground': link.active }"
        v-html="link.label"
      />
    </div>
  </AppSidebarLayout>
</template>
