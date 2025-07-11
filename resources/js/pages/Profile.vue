<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppHeader from '@/components/AppHeader.vue';
import AppFooter from '@/components/AppFooter.vue';
import ProfileHeader from '@/components/profile/ProfileHeader.vue';
import ProfileFarms from '@/components/profile/ProfileFarms.vue';
import ProfileFavorites from '@/components/profile/ProfileFavorites.vue';
import ProfileOrders from '@/components/profile/ProfileOrders.vue';

defineProps<{ user: any }>();
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <AppHeader />
    <Head title="User Profile" />
    <main class="flex-1 bg-background pb-12">
      <div class="max-w-3xl mx-auto px-4 py-12">
        <ProfileHeader :user="user" />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
          <ProfileFarms :user="user" />
          <ProfileFavorites :user="user" />
        </div>
        <div class="mt-8">
          <ProfileOrders :user="user" />
        </div>
      </div>
    </main>
    <AppFooter />
  </div>
</template> 