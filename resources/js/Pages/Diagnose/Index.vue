<template>
    <Head title="Make Diagnostic" />
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center">
          <!-- Title -->
          <h2 class="font-semibold lg:text-xl md:text-lg text-sm text-gray-800 leading-tight">Make Diagnostic</h2>
          <!-- Search Input -->
          <div class="flex items-center">
            <div class="relative text-gray-500 focus-within:text-gray-900">
              <div class="absolute inset-y-0 left-1 flex items-center pl-3 pointer-events-none">
                <!-- Search Icon -->
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round" />
                    <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                    <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                </svg>
              </div>
              <input
                type="text"
                id="default-search"
                v-model="searchQuery"
                class="block w-80 h-11 pr-5 pl-12 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                placeholder="Search Patient"
              />
            </div>
          </div>
        </div>
      </template>
  
      <div class="flex flex-col min-h-screen">
        <main class="flex-grow">
          <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row w-full justify-center">
              <!-- Main content section -->
              <div class="w-full p-1 mt-2">
                <div class="flex shadow flex-col">
                  <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                      <div class="overflow-hidden">
                        <table class="min-w-full rounded-xl shadow-lg">
                          <thead>
                            <tr class="bg-gray-50">
                              <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Full Name</th>
                              <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Sex</th>
                              <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Address</th>
                              <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">Contact #</th>
                              <th class="p-5 text-center text-sm leading-6 font-semibold text-gray-900 capitalize">Vital Signs</th>
                              <th class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">Actions</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-300">
                            <tr
                              class="bg-white transition-all duration-500 hover:bg-gray-50"
                              v-for="(individualRecord, index) in individualRecords"
                              :key="individualRecord.id"
                            >
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ individualRecord.patient.name }} {{ individualRecord.patient.lname }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ individualRecord.patient.gender }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ individualRecord.patient.address }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ individualRecord.patient.contact_no || 'N/A' }}</td>
                              <td class="p-5 text-sm leading-6 font-medium text-white bg-orange-500 text-center break-words whitespace-normal">
                                <div>
                                  {{ individualRecord.vital_signs }}
                                </div>
                              </td>
                              <td class="p-5">
                                <div class="flex items-center gap-1">
                                  <button
                                    @click="redirectToUpdate(individualRecord.id)"
                                    class="p-2 rounded-lg group transition-all duration-500 flex items-center bg-blue-500 hover:bg-blue-600 text-white"
                                  >
                                  <i class="fa-solid fa-notes-medical"></i> Diagnose
                                  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End main content section -->
            </div>
          </div>
        </main>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
  individualRecords: { type: Array, required: true },
});

const searchQuery = ref("");

const filteredRecords = computed(() => {
  if (!searchQuery.value.trim()) {
    return props.individualRecords;
  }

  const query = searchQuery.value.toLowerCase();
  return props.individualRecords.filter((record) => {
    const fullName = `${record.patient.name} ${record.patient.lname}`.toLowerCase();
    const gender = record.patient.gender?.toLowerCase();
    const address = record.patient.address?.toLowerCase();
    return (
      fullName.includes(query) ||
      gender.includes(query) ||
      address.includes(query)
    );
  });
});

const redirectToUpdate = (id) => {
  Swal.fire({
    title: "Diagnose this Patient?",
    text: "You will be redirected to the diagnostic page.",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Yes, diagnose!",
    cancelButtonText: "No, cancel!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `/update-diagnostic/${id}`; // Adjust the route as needed
    }
  });
};
</script>

  