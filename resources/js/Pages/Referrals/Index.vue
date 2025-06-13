<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { useForm, Link } from '@inertiajs/vue3'

defineProps({
  users: Array
})

const referralForm = useForm({
  referrer_id: null,
  referred_id: null,
  notes: ''
})

function createReferral(referrerId, referredId) {
  referralForm.referrer_id = referrerId
  referralForm.referred_id = referredId
  referralForm.notes = prompt("Optional notes:", '')

  if (referralForm.referred_id !== referralForm.referrer_id) {
    referralForm.post(route('referrals.store'), {
      onSuccess: () => {
        alert("Referral sent!")
      }
    })
  } else {
    alert("You cannot refer yourself.")
  }
}
</script>

<template>
  <div class="p-4">
    <h1 class="text-xl font-bold mb-4">Users</h1>
    <div class="grid gap-4">
      <div v-for="user in users" :key="user.id" class="border p-4 rounded shadow">
        <div class="font-semibold">{{ user.name }} {{ user.lname }}</div>
        <div class="text-sm text-gray-600">{{ user.email }}</div>
        <div class="mt-2">
          <Link
            :href="route('referrals.create', user.id)"
            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
            >
            Refer this user
            </Link>
        </div>
      </div>
    </div>
  </div>
</template>
