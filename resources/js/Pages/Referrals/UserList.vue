<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
  referred:  Object, // user being viewed
  referrals: Array,  // list of referrals about that user
})

// native date‑format helper
function fmt(ds) {
  return new Date(ds).toLocaleString('en-US', {
    year:   'numeric',
    month:  'short',
    day:    '2-digit',
    hour:   '2-digit',
    minute: '2-digit',
  })
}
</script>

<template>
  <!-- Browser‑tab title -->
  <Head :title="`Referrals for ${referred.name} ${referred.lname}`" />

  <AuthenticatedLayout>
    <!-- HEADER SLOT -->
    <template #header>
      <div class="flex justify-between items-center gap-4">
        <h1 class="text-2xl font-bold">
          Referrals for {{ referred.name }} {{ referred.lname }}
        </h1>
        <Link
          :href="route('referrals.index')"
          class="text-gray-600 hover:underline"
        >
          ← Back
        </Link>
      </div>
    </template>

    <!-- PAGE BODY -->
    <div class="py-6 space-y-6">
      <div v-if="referrals.length" class="overflow-x-auto bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 rounded-lg">
        <table class="min-w-full table-auto border rounded-lg shadow-sm">
          <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
            <tr>
              <th class="px-4 py-2 border-b">Referrer</th>
              <th class="px-4 py-2 border-b">Date</th>
              <th class="px-4 py-2 border-b">Notes</th>
              <th class="px-4 py-2 border-b text-right">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="ref in referrals"
              :key="ref.id"
              class="hover:bg-gray-50 transition"
            >
              <td class="px-4 py-2 border-b">
                {{ ref.referrer.name }} {{ ref.referrer.lname }}
              </td>
              <td class="px-4 py-2 border-b text-sm text-gray-600">
                {{ fmt(ref.created_at) }}
              </td>
              <td class="px-4 py-2 border-b text-sm whitespace-pre-wrap max-w-sm">
                {{ ref.notes || '— no notes —' }}
              </td>
              <td class="px-4 py-2 border-b text-right">
                <Link
                  :href="route('referrals.show', ref.id)"
                  class="text-indigo-600 hover:underline text-sm"
                >
                  View
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p v-else class="text-gray-500">
        No referrals found for this user.
      </p>
    </div>
  </AuthenticatedLayout>
</template>
