<script setup>
import { defineProps } from 'vue';

defineProps({
  message: String,
});
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-gray-50 p-6">
    <div class="bg-white p-8 text-center w-full max-w-md space-y-4">
      <!-- Pending Icon with animation -->
      <div class="inline-block p-4 rounded-full bg-blue-50 animate-pulse">
        <i class="fas fa-hourglass-half text-blue-600 text-3xl"></i>
      </div>
      
      <h2 class="text-2xl font-bold text-gray-800">Account Pending</h2>
      <p class="text-gray-600">{{ message }}</p>
  
      <!-- Enhanced Button -->
      <a 
        href="/login" 
        class="mt-6 inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-500 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 ease-in-out transform hover:-translate-y-0.5"
      >
        <i class="fas fa-sign-in-alt mr-2"></i>
        <span>Back to Login</span>
      </a>
      
    </div>
  </div>
</template>

<style scoped>
/* Custom transition for smoother hover effects */
a {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}
</style>