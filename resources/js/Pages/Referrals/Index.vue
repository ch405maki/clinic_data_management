<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({ users: Array })
</script>

<template>
  <div class="p-4 space-y-6">
    <h1 class="text-xl font-bold">Users</h1>

    <div class="grid gap-4">
      <div
        v-for="user in users"
        :key="user.id"
        class="border p-4 rounded shadow space-y-2"
      >
        <div class="font-semibold">
          {{ user.name }} {{ user.lname }}
        </div>

        <div class="text-sm text-gray-600">
          {{ user.email }}
        </div>

        <!-- NEW: referral count -->
        <div class="text-sm text-gray-500">
          Referrals: {{ user.referral_count }}
        </div>

        <div class="flex gap-2">
          <Link
            :href="route('referrals.create', user.id)"
            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
          >
            Refer
          </Link>

          <Link
            :href="route('users.referrals', user.id)"
            class="bg-emerald-600 text-white px-3 py-1 rounded hover:bg-emerald-700"
          >
            Show Referrals
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
