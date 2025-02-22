<template>
  <Head title="Welcome" />
  <!-- Navbar -->
  <nav class="bg-white border-b-2 shadow-lg">
    <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-2">
      <a href="#" class="flex items-center space-x-3">
        <img src="/images/logo.png" class="h-12" alt="Clinic Data Management System" />
        <div class="flex flex-col">
          <span class="lg:text-xl md:text-lg text-sm font-semibold">Clinic Data Management System</span>
          <span class="lg:text-base md:text-sm text-xs text-gray-500">Purok 6, Bulanao Tabuk City, Kalinga</span>
        </div>
      </a>
      
      <!-- Desktop Navbar Links -->
      <div class="hidden md:flex md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col md:flex-row items-center justify-between p-4 md:p-0 rounded-lg md:space-x-8">
          <li>
            <a href="/" class="block py-2 px-3 text-gray-900 bg-green-700 rounded md:bg-transparent md:text-green-700 md:p-0 dark:text-white">Home</a>
          </li>
          <template v-if="navigation.canLogin">
            <li v-if="$page.props.auth.user" class="flex">
              <Link :href="route('dashboard')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 dark:text-white">Dashboard</Link>
            </li>
            <li v-else class="flex items-center space-x-4">
              <Link :href="route('login')" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 dark:text-white">Log in</Link>
              <template v-if="navigation.canRegister">
                <Link :href="route('register')" class="block py-3 px-6 text-white bg-green-600 rounded-full hover:bg-green-700 transition duration-300">Register</Link>
              </template>
            </li>
          </template>
        </ul>
      </div>
      
      <!-- Mobile Menu Button -->
      <button @click="toggleDrawer" class="md:hidden p-2 w-8 h-8 text-gray-500 rounded-lg hover:bg-gray-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>
  </nav>
  
  <!-- Mobile Drawer -->
  <div v-if="isDrawerOpen" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="toggleDrawer"></div>
  <aside class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg transform transition-transform z-50"
         :class="isDrawerOpen ? 'translate-x-0' : '-translate-x-full'">
    <div class="p-4 flex justify-between items-center border-b">
      <h2 class="text-lg font-semibold">Menu</h2>
      <button @click="toggleDrawer" class="p-2 text-gray-500 hover:bg-gray-200 rounded-full">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <ul class="p-4 space-y-4">
      <li><a href="/" class="block py-2 px-4 rounded hover:bg-gray-100">Home</a></li>
      <li><a :href="route('login')" class="block py-2 px-4 rounded hover:bg-gray-100">Log in</a></li>
      <li><a :href="route('register')" class="block py-2 px-4 rounded bg-green-600 text-white hover:bg-green-700">Register</a></li>
    </ul>
  </aside>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  navigation: Object,
});

const isDrawerOpen = ref(false);
const toggleDrawer = () => {
  isDrawerOpen.value = !isDrawerOpen.value;
};
</script>

<style scoped>
/* Smooth transition for drawer */
aside {
  transition: transform 0.3s ease-in-out;
}
</style>
