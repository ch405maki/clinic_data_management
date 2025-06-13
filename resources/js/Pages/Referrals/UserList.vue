<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  referred:  Object, // user being viewed
  referrals: Array,
})

// helper—no external libs
function fmt(ds) {
  return new Date(ds).toLocaleString('en-US', {
    year:  'numeric',
    month: 'short',
    day:   '2-digit',
    hour:  '2-digit',
    minute:'2-digit',
  })
}
</script>

<template>
  <div class="p-6 space-y-6">
    <!-- HEADER -->
    <div class="flex items-center gap-4">
      <Link
        :href="route('referrals.index')"
        class="text-gray-600 hover:underline"
      >
        ← Back
      </Link>
      <h1 class="text-2xl font-bold">
        Referrals for {{ referred.name }} {{ referred.lname }}
      </h1>
    </div>

    <!-- LIST -->
    <div v-if="referrals.length" class="space-y-4">
      <div
        v-for="ref in referrals"
        :key="ref.id"
        class="border rounded-lg p-4 shadow"
      >
        <div class="font-semibold">
          Referrer: {{ ref.referrer.name }} {{ ref.referrer.lname }}
        </div>

        <div class="text-gray-500 text-sm">
          {{ fmt(ref.created_at) }}
        </div>

        <div class="mt-2 whitespace-pre-wrap">
          {{ ref.notes || '— no notes —' }}
        </div>

        <Link
          :href="route('referrals.show', ref.id)"
          class="inline-block mt-3 text-indigo-600 hover:underline text-sm"
        >
          View detail
        </Link>
      </div>
    </div>

    <p v-else class="text-gray-500">No referrals found for this user.</p>
  </div>
</template>
