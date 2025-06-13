<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">My Referrals</h1>

    <table class="w-full border rounded-lg overflow-hidden">
      <thead class="bg-gray-100 text-left text-sm">
        <tr>
          <th class="p-3">Referred User</th>
          <th class="p-3">Notes</th>
          <th class="p-3">Date</th>
          <th class="p-3"></th>
        </tr>
      </thead>

      <tbody>
        <tr
          v-for="ref in referrals"
          :key="ref.id"
          class="border-t last:border-b"
        >
          <td class="p-3">
            {{ ref.referred.name }} {{ ref.referred.lname }}
            <div class="text-xs text-gray-500">{{ ref.referred.email }}</div>
          </td>

          <td class="p-3 w-1/2 truncate">
            {{ ref.notes || '—' }}
          </td>

          <td class="p-3">
            {{ fmt(ref.created_at) }}
          </td>

          <td class="p-3">
            <Link
              :href="route('referrals.show', ref.id)"
              class="text-indigo-600 hover:underline"
            >
              View
            </Link>
          </td>
        </tr>

        <tr v-if="!referrals.length">
          <td colspan="4" class="p-4 text-center text-gray-500">
            No referrals yet.
          </td>
        </tr>
      </tbody>
    </table>

    <div class="mt-6">
      <Link
        :href="route('referrals.index')"
        class="text-sm text-gray-600 hover:underline"
      >
        ← Back to users
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  components: { Link },

  props: {
    referrals: {
      type: Array,
      required: true,
    },
  },

  methods: {
    // Native formatting—no external libs
    fmt(dateStr) {
      return new Date(dateStr).toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
      })
    },
  },
}
</script>
