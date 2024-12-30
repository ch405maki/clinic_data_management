<template>
    <v-carousel
      height="400"
      show-arrows="hover"
      cycle
      hide-delimiter-background
  >
      <v-carousel-item
          v-for="(item, i) in items"
          :key="i"
      >
          <img :src="item.src" class="w-full h-full object-cover" alt="Carousel image">
      </v-carousel-item>
  </v-carousel>
</template>

<script setup>
import { ref } from 'vue';

const items = ref([
    {
        src: 'images/bulanaoHall.jpg',
    },
    {
        src: 'images/image1.jpg',
    },
    {
        src: 'images/image2.jpg',
    },
    
]);
</script>