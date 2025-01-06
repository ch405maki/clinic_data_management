<template>
    <Head title="Welcome" />
    <!-- navbar -->
    <Nav :navigation="navigation" />
    <!-- end navbar -->

    <div class="relative h-[80vh] overflow-hidden">
      <div class="absolute inset-0">
        <img src="images/hero.jpg" alt="Background Image" class="object-cover object-center w-full h-full" />
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/50 to-white opacity-86"></div>
      </div>

      <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
          <h1 class="text-6xl font-extrabold leading-tight mb-4 text-gray-900">Welcome to <span class="font-extrabold relative whitespace-nowrap text-green-700">
            <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute top-2/3 left-0 h-[0.58em] w-full fill-green-500/70" preserveAspectRatio="none"><path d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z"></path></svg>
            <span class="relative">KSU Dental Clinic</span></span>
          </h1>
        <p class="text-2xl font-semibold text-gray-600 mb-8">Here to fix teeth and give confidence with your smiles</p>
        <a :href="route('register')" class="bg-green-600 text-white hover:bg-green-500 py-3 px-8 rounded-full text-lg font-bold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Get Started</a>
      </div>  
    </div>

    
      
    <div class="text-gray-600 body-font bg-white">
      <div class="max-w-7xl mx-auto px-8 flex md:flex-row flex-col items-center py-10">
          <div
              class="lg:flex-grow mt-5 md:mt-0 md:w-1.5/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
              <h1
                  class="text-3xl font-extrabold leading-9 tracking-tight mb-3 text-gray-900 dark:text-gray-100 md:leading-normal">
                  Clinic Data Management System <br>
                  <p class="text-xl">For Kalinga State University Health Service</p>
              </h1>
              <p class="mb-8 md:pl-0  pl-2 pr-2 leading-relaxed dark:text-gray-300">
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
