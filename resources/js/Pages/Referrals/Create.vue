<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  referred: Object,   // user being referred
  referrer: Object,   // current logged‑in user
})

const form = useForm({
  referred_id: props.referred.id,
  notes: '',
})

function submit() {
  form.post(route('referrals.store'), {
    onSuccess: () => router.visit(route('referrals.index')),
  })
}
</script>

<template>
  <!-- Page title for the browser tab -->
  <Head title="Create Referral" />

  <AuthenticatedLayout>
    <!-- HEADER SLOT -->
    <template #header>
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-xl font-bold">Create Referral</h1>
          <p class="text-sm">Compose a referral for {{ referred.name }} {{ referred.lname }}</p>
        </div>
        <button class="bg-green-600 px-4 py-2 rounded-sm text-white hover:bg-green-700">
            Print
        </button>
      </div>
    </template>

    <!-- PAGE BODY -->
    <div class="py-6">
      <div class="grid gap-6 md:grid-cols-2">
        <!-- LEFT COLUMN — preview -->
        <aside class="border rounded-lg p-4 shadow">
          <h2 class="text-lg font-semibold mb-4">Preview</h2>

          <!-- Referred person -->
          <div class="flex items-center space-x-4">
            <img
              :src="referred.profile_picture
                    ? `/storage/profile_pictures/${referred.profile_picture}`
                    : '/images/avatar.png'"
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
              {{ form.notes || '— your note will appear here —' }}
            </p>
          </div>
        </aside>

        <!-- RIGHT COLUMN — input -->
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
  </AuthenticatedLayout>
</template>
