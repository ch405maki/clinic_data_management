<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ referral: Object })

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
  <div class="p-6 max-w-xl mx-auto space-y-6">
    <h1 class="text-2xl font-bold">Referral Details</h1>

    <div class="border rounded-lg p-4 space-y-4 shadow">
      <div>
        <h2 class="font-semibold">Referred User</h2>
        <p>{{ referral.referred.name }} {{ referral.referred.lname }}</p>
        <p class="text-sm text-gray-600">{{ referral.referred.email }}</p>
      </div>

      <div>
        <h2 class="font-semibold">Referrer</h2>
        <p>{{ referral.referrer.name }} {{ referral.referrer.lname }}</p>
        <p class="text-sm text-gray-600">{{ referral.referrer.email }}</p>
      </div>

      <div>
        <h2 class="font-semibold">Notes</h2>
        <p class="whitespace-pre-wrap">{{ referral.notes || '—' }}</p>
      </div>

      <div class="text-sm text-gray-500">
        Created: {{ fmt(referral.created_at) }}
      </div>
    </div>

    <div>
      <Link :href="route('referrals.list')" class="text-sm text-gray-600 hover:underline">
        ← Back to referrals
      </Link>
    </div>
  </div>
</template>
