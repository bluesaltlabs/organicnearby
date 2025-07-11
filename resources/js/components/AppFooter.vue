<script setup lang="ts">
import { footerConfig } from '@/lib/footerConfig';
</script>

<template>
  <footer class="bg-background border-t border-border mt-8 text-foreground">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
      <div v-for="section in footerConfig" :key="section.heading">
        <h3 class="font-semibold mb-2">{{ section.heading }}</h3>
        <ul v-if="section.heading !== 'Download the Mobile App!'" class="space-y-1">
          <li v-for="link in section.links" :key="link.label">
            <a :href="link.href" class="hover:underline">{{ link.label }}</a>
          </li>
        </ul>
        <div v-else class="flex flex-col space-y-2">
          <a v-for="link in section.links" :key="link.label" :href="link.href" class="inline-block">
            <img v-if="(link as any).img" :src="(link as any).img" :alt="link.label" class="h-10" />
            <span v-else>{{ link.label }}</span>
          </a>
        </div>
      </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between border-t border-border">
      <form class="flex items-center space-x-2 mb-2 md:mb-0">
        <label for="newsletter" class="font-semibold">Stay up-to-date with our newsletter</label>
        <input id="newsletter" type="email" placeholder="Enter your email" class="px-3 py-2 border border-input rounded-lg bg-background text-foreground placeholder:text-muted-foreground" />
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 transition">Subscribe</button>
      </form>
      <span class="text-muted-foreground text-xs">© OrganicNearby</span>
    </div>
  </footer>
</template> 