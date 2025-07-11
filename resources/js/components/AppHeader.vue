<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import UserMenuContent from '@/components/UserMenuContent.vue';
import { getInitials } from '@/composables/useInitials';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet';
import { Menu } from 'lucide-vue-next';

// Configurable navigation menu
const navMenu = [
  { title: 'Products', href: '/products' },
  { title: 'Community', href: '/community' },
  { title: 'About', href: '/about' },
  { title: 'Manage Store', href: '/admin', highlight: true },
];

const page = usePage();
const auth = computed(() => page.props.auth);
const location = 'Spokane, WA'; // Replace with dynamic location if available
</script>

<template>
  <header class="w-full border-b border-border bg-background">
    <div class="mx-auto flex h-16 items-center px-4 md:max-w-7xl">
      <!-- Logo Slot -->
      <Link :href="route('home')" class="flex items-center gap-x-2 mr-8">
        <img src="/logo.png" alt="OrganicNearby Logo" class="h-8 w-auto" />
        <span class="sr-only">OrganicNearby</span>
      </Link>

      <!-- Desktop Navigation & User Menu -->
      <div class="hidden md:flex flex-1 items-center justify-end">
        <nav>
          <ul class="flex items-center gap-2">
            <li v-for="item in navMenu" :key="item.title">
              <Link
                :href="item.href"
                class="px-4 py-2 rounded-lg font-medium text-sm transition focus:outline-none focus:ring-2 focus:ring-primary"
                :class="item.highlight
                  ? 'bg-green-500 text-white hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500 shadow'
                  : 'text-foreground hover:bg-accent dark:hover:bg-muted'"
              >
                {{ item.title }}
                <span v-if="item.title === 'Community'" class="ml-1 inline-block h-2 w-2 rounded-full bg-orange-400 align-middle"></span>
              </Link>
            </li>
          </ul>
        </nav>
        <div class="ml-4 flex items-center space-x-2">
          <DropdownMenu>
            <DropdownMenuTrigger :as-child="true">
              <button
                class="relative size-10 w-auto rounded-full p-1 focus-within:ring-2 focus-within:ring-primary bg-transparent border-none"
              >
                <Avatar class="size-8 overflow-hidden rounded-full">
                  <AvatarImage v-if="auth.user && auth.user.avatar" :src="auth.user.avatar" :alt="auth.user.name" />
                  <AvatarFallback class="rounded-lg bg-neutral-200 font-semibold text-black dark:bg-neutral-700 dark:text-white">
                    {{ getInitials(auth.user?.name || '') }}
                  </AvatarFallback>
                </Avatar>
              </button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" class="w-56">
              <UserMenuContent :user="auth.user" />
            </DropdownMenuContent>
          </DropdownMenu>
        </div>
      </div>

      <!-- Mobile Hamburger Menu -->
      <div class="ml-auto md:hidden flex items-center">
        <Sheet>
          <SheetTrigger as-child>
            <button class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
              <Menu class="h-7 w-7 text-green-700" />
              <span class="sr-only">Open menu</span>
            </button>
          </SheetTrigger>
          <SheetContent side="left" class="w-[320px] p-4">
            <SheetHeader class="flex items-center justify-between mb-6">
              <div class="flex items-center gap-x-2">
                <img src="/logo.png" alt="OrganicNearby Logo" class="h-8 w-auto" />
                <span class="font-bold text-lg text-green-700">Organic<span class="text-red-500">Nearby</span></span>
              </div>
            </SheetHeader>
            <div class="flex flex-col gap-4 mb-4">
              <Link :href="route('profile.show')" class="flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-sm bg-muted hover:bg-accent">
                <Avatar class="size-6 overflow-hidden rounded-full">
                  <AvatarImage v-if="auth.user && auth.user.avatar" :src="auth.user.avatar" :alt="auth.user.name" />
                  <AvatarFallback class="rounded-lg bg-neutral-200 font-semibold text-black dark:bg-neutral-700 dark:text-white">
                    {{ getInitials(auth.user?.name || '') }}
                  </AvatarFallback>
                </Avatar>
                <span>View Profile</span>
              </Link>
              <Link v-if="navMenu.find(i => i.highlight)?.href" :href="navMenu.find(i => i.highlight)!.href" class="px-4 py-2 rounded-lg font-semibold text-white bg-green-500 hover:bg-green-600 text-center">Manage Store</Link>
              <div class="flex items-center gap-2 px-4 py-2 rounded-lg bg-muted text-sm">
                <svg class="h-5 w-5 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657A8 8 0 118 7.343a8 8 0 019.657 9.314z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <span>{{ location }}</span>
              </div>
            </div>
            <nav class="flex flex-col gap-2">
              <Link v-for="item in navMenu.filter(i => !i.highlight)" :key="item.title" :href="item.href" class="px-4 py-2 rounded-lg font-medium text-sm text-foreground hover:bg-accent">
                {{ item.title }}
              </Link>
            </nav>
          </SheetContent>
        </Sheet>
      </div>
    </div>
  </header>
</template>
