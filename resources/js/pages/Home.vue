<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppHeader from '@/components/AppHeader.vue';
import AppFooter from '@/components/AppFooter.vue';

</script>

<template>
  <div class="flex flex-col min-h-screen">
    <AppHeader />
    <Head title="Fresh local produce & products near you!" />
    <main class="flex-1 bg-background pb-12">
      <section class="max-w-5xl mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Fresh local produce & products near you!</h1>
        <p class="text-lg md:text-xl text-muted-foreground mb-8">Discover, buy, and support local farms and producers in your area.</p>
        <div class="flex flex-col md:flex-row gap-4 justify-center mb-8">
          <Link href="/farms/MapView" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition">View Farm Map</Link>
          <Link href="/products" class="inline-block px-6 py-3 bg-card border border-green-600 text-green-700 dark:text-green-300 rounded-lg font-semibold shadow hover:bg-accent transition">Browse Products</Link>
        </div>
        <div class="max-w-xl mx-auto">
          <input type="text" placeholder="Search products or farms..." class="w-full px-4 py-3 rounded-lg border border-input bg-background text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-green-400" />
        </div>
      </section>
      <section class="max-w-5xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Featured Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          <div class="bg-card rounded-lg shadow p-4 text-center">Bakery & Grains</div>
          <div class="bg-card rounded-lg shadow p-4 text-center">Fresh Produce</div>
          <div class="bg-card rounded-lg shadow p-4 text-center">Dairy & Eggs</div>
          <div class="bg-card rounded-lg shadow p-4 text-center">Meat & Poultry</div>
        </div>
      </section>
    </main>
    <AppFooter />
  </div>
</template> 