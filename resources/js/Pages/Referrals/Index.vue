<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref, watch } from 'vue'

const props = defineProps({
  users: Array,
  filters: Object,   // { search: '...' }
})

const search = ref(props.filters?.search ?? '')

// debounce (300 ms)
let t
watch(search, val => {
  clearTimeout(t)
  t = setTimeout(() => {
    router.get(
      route('referrals.index'),
      { search: val },
      { preserveState: true, replace: true, preserveScroll: true }
    )
  }, 300)
})
</script>

<template>
  <!-- Multiple root nodes are fine in Vue 3 -->
  <Head title="Referral" />

  <AuthenticatedLayout>
    <!-- SLOT ‑ must be a direct child of AuthenticatedLayout -->
    <template #header>
      <div class="flex justify-between items-center">
        <div>
          <h1 class="text-xl font-bold">Referral</h1>
          <p class="text-sm">List of registered patients</p>
        </div>

        <!-- SEARCH -->
        <input
          v-model="search"
          type="text"
          placeholder="Search by name or email…"
          class="border rounded-lg px-3 py-2 w-full md:w-80 focus:outline-none focus:ring"
        />
      </div>
    </template>

    <!-- PAGE BODY -->
    <div class="py-6">
    <div class="mx-auto space-y-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border rounded-lg shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                <th class="text-left px-4 py-4 text-sm font-semibold text-gray-700">Name</th>
                <th class="text-left text-sm font-semibold text-gray-700">Email</th>
                <th class="text-left text-sm font-semibold text-gray-700">Referral Count</th>
                <th class="text-right text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                v-for="user in users"
                :key="user.id"
                class="border-b hover:bg-gray-50"
                >
                <td class="px-4 py-2">
                    {{ user.name }} {{ user.lname }}
                </td>
                <td class="px-4 py-2 text-sm text-gray-600">
                    {{ user.email }}
                </td>
                <td class="px-4 py-2 text-sm text-gray-500">
                    {{ user.referral_count }}
                </td>
                <td class="px-4 py-2 text-right">
                    <div class="flex justify-end gap-2">
                    <Link
                        :href="route('referrals.create', user.id)"
                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm"
                    >
                        Refer
                    </Link>
                    <Link
                        :href="route('users.referrals', user.id)"
                        class="bg-emerald-600 text-white px-3 py-1 rounded hover:bg-emerald-700 text-sm"
                    >
                        Show Referrals
                    </Link>
                    </div>
                </td>
                </tr>

                <tr v-if="!users.length">
                <td colspan="4" class="text-center text-gray-500 px-4 py-6">
                    No users match your search.
                </td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>

  </AuthenticatedLayout>
</template>
