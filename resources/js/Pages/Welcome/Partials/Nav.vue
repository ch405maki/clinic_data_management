<template>
    <Head title="Welcome" />
    <!-- Navbar -->
    <nav class="bg-white border-gray-200 border-b-2 shadow-lg">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="/images/logo.png" class="h-12" alt="KSU Dental Clinic Logo" />
          <div class="flex flex-col">
            <span class="self-start sm:text-2xl font-semibold">KSU Dental Clinic</span>
            <span class="self-start text-sm text-gray-500">Purok 6, Bulanao Tabuk City, Kalinga</span>
          </div>
        </a>
        <!-- Mobile Menu Button -->
        <button
          data-collapse-toggle="navbar-default"
          type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
          aria-controls="navbar-default"
          aria-expanded="false"
        >
          <span class="sr-only">Open main menu</span>
          <svg
            class="w-5 h-5"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 17 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M1 1h15M1 7h15M1 13h15"
            />
          </svg>
        </button>
        <!-- Navbar Links -->
        <div class="hidden w-full md:flex md:w-auto" id="navbar-default">
          <ul class="font-medium flex flex-col md:flex-row items-center justify-between p-4 md:p-0 rounded-lg md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
            <li>
              <a
                href="/"
                class="block py-2 px-3 text-gray-900 bg-green-700 rounded md:bg-transparent md:text-green-700 md:p-0 dark:text-white"
              >
                Home
              </a>
            </li>
            <li>
              <a
                :href="route('about')"
                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 dark:text-white"
              >
                About
              </a>
            </li>
            <li>
              <a
                :href="route('about')"
                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 dark:text-white"
              >
                Contact
              </a>
            </li>
            <template v-if="navigation.canLogin">
              <li v-if="$page.props.auth.user" class="flex">
                <Link
                  :href="route('admin.dashboard')"
                  class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 dark:text-white"
                >
                  Dashboard
                </Link>
              </li>
              <li v-else class="flex items-center space-x-4 rtl:space-x-reverse">
                <Link
                  :href="route('login')"
                  class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-green-700 md:p-0 dark:text-white"
                >
                  Log in
                </Link>
                <template v-if="navigation.canRegister">
                  <Link
                    :href="route('register')"
                    class="block py-3 px-6 text-white bg-green-600 rounded-full hover:bg-green-700 transition duration-300"
                  >
                    Register
                  </Link>
                </template>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>
  </template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

// Accept the navigation prop from Inertia
defineProps({
  navigation: Object,
});
</script>

<style scoped>
/* Add any additional styles you need */
</style>
