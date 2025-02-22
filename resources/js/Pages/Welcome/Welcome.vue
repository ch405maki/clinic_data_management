<template>
    <Head title="Welcome" />
    <!-- navbar -->
    <Nav :navigation="navigation" />
    <!-- end navbar -->

    <div class="relative min-h-screen overflow-hidden flex items-center justify-center px-6 sm:px-12">
      <!-- Background Image -->
      <div class="absolute inset-0">
        <img src="images/hero.jpg" alt="Background Image" class="object-cover object-center w-full h-full" />
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/50 to-white opacity-86"></div>
      </div>

      <!-- Content -->
      <div class="relative z-10 text-center mt-[-100px] max-w-2xl">
        <h1 class="lg:text-6xl md:text-5xl text-3xl sm:text-2xl font-extrabold leading-tight mb-4 text-gray-900">
          Welcome to 
          <span class="font-extrabold relative text-green-700">
            <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute top-2/3 left-0 h-[0.58em] w-full fill-green-500/70" preserveAspectRatio="none">
              <!-- ... (rest of the SVG code remains the same) -->
            </svg>
            <span class="relative whitespace-nowrap">University Health Service</span>
          </span>
        </h1>

        <p class="lg:text-2xl md:text-xl text-lg font-semibold text-gray-600 mb-6">
          Manage patient records and more with ease.
        </p>

        <a :href="route('register')" class="bg-green-600 text-white hover:bg-green-500 py-3 px-6 sm:px-8 rounded-full text-lg font-bold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
          Get Started
        </a>
      </div>
    </div>

    <div class="text-gray-600 body-font bg-white">
      <div class="max-w-7xl mx-auto px-8 flex md:flex-row flex-col items-center py-10">
          <div
              class="lg:flex-grow mt-5 md:mt-0 md:w-1.5/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
              <h1
                  class="text-3xl font-extrabold leading-9 tracking-tight mb-3 text-gray-900 md:leading-normal">
                  Clinic Data Management System <br>
                  <p class="text-xl">For Kalinga State University Health Service</p>
              </h1>
              <p class="mb-8 md:pl-0  pl-2 pr-2 leading-relaxed">
                Manage clinic data efficiently with our innovative system, designed to streamline healthcare services for KSU Health Service.
              </p>
          </div>
          <div class="lg:max-w-lg lg:w-full mb-5 md:mb-0 md:w-1/2 w-3/6">
              <img class="object-cover object-center rounded" alt="hero" src="images/register.jpg">
          </div>
      </div>
    </div>

    <Footer />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Carousel from '@/Pages/Welcome/Partials/Carousel.vue';
import Footer from '../../Layouts/Footer.vue';
import Nav from './Partials/Nav.vue';

const props = defineProps({
  posts: {
    type: Array,
    required: true,
  },
  navigation: {
    type: Object,
    required: true,
  },
  canLogin: {
    type: Boolean,
    required: true,
  },
  canRegister: {
    type: Boolean,
    required: true,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  }
});
</script>


<style>
/* You can add additional styles here if needed */
</style>
