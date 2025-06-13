<script setup>
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  referred: Object,   // supplied by controller
  referrer: Object,
})

const form = useForm({
  referred_id: props.referred.id,
  notes: '',
})

function submit() {
  form.post(route('referrals.store'))
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Create Referral</h1>

    <div class="grid gap-6 md:grid-cols-2">
      <!-- LEFT COLUMN — preview -->
      <aside class="border rounded-lg p-4 shadow">
        <h2 class="text-lg font-semibold mb-4">Preview</h2>

        <!-- Referred person -->
        <div class="flex items-center space-x-4">
          <img
            :src="referred.profile_picture ?? '/img/default-avatar.png'"
            class="w-16 h-16 rounded-full object-cover"
          />
          <div>
            <p class="font-medium">{{ referred.name }} {{ referred.lname }}</p>
            <p class="text-gray-600 text-sm">{{ referred.email }}</p>
          </div>
        </div>

        <!-- Referrer -->
        <div class="mt-6 text-sm text-gray-500">
          <span class="font-semibold">Referrer:</span>
          {{ referrer.name }} {{ referrer.lname }}
        </div>

        <!-- Live note preview -->
        <div class="mt-6">
          <h3 class="font-semibold mb-1">Note preview</h3>
          <p class="whitespace-pre-wrap">
            {{ form.notes || '— your note will appear here —' }}
          </p>
        </div>
      </aside>

      <!-- RIGHT COLUMN — input -->
      <section>
        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label class="block text-sm font-medium mb-1">Notes (optional)</label>
            <textarea
              v-model="form.notes"
              class="w-full border rounded-lg p-3 min-h-[160px]"
              placeholder="Write a short note for this referral..."
            ></textarea>
          </div>

          <div class="flex space-x-3">
            <button
              type="submit"
              :disabled="form.processing"
              class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 disabled:opacity-50"
            >
              Create Referral
            </button>

            <Link
              :href="route('referrals.index')"
              class="px-4 py-2 rounded border"
            >
              Cancel
            </Link>
          </div>
        </form>
      </section>
    </div>
  </div>
</template>
