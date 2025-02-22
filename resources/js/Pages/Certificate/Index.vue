<template>
    <div>
      <Head title="Reports" />
      <AuthenticatedLayout>
        <template #header>
          <div class="flex justify-between items-center">
            <!-- Heading Section -->
            <h2 class="font-semibold lg:text-xl md:text-lg text-sm text-gray-800 leading-tight">
                Medical Certificate
            </h2>
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
              v-model="searchQuery"
              type="text"
              placeholder="Search here..."
              class="block w-80 h-11 pr-5 pl-12 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
              />
            </div>
          </div>
            <!-- Search Input -->
          </div>
        </template>
  
        <div class="py-6">
          <div class="mx-auto space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 rounded-lg">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead>
                    <tr class="bg-gray-100 rounded-lg">
                      <th class="px-4 py-2 text-left">Full Name</th>
                      <th class="px-4 py-2 text-left">Contact No.</th>
                      <th class="px-4 py-2 text-left">Email</th>
                      <th class="px-4 py-2 text-left">Address</th>
                      <th class="px-4 py-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-gray-700">
                    <tr
                      v-for="(record, index) in filteredRecords"
                      :key="index"
                      class="border-b border-gray-200 hover:bg-gray-100 text-sm"
                    >
                      <td class="px-4 py-2">
                        {{ record.patient?.lname }}, {{ record.patient?.name }}
                      </td>
                      <td class="px-4 py-2">{{ record.patient?.contact_no }}</td>
                      <td class="px-4 py-2">{{ record.patient?.email }}</td>
                      <td class="px-4 py-2">{{ record.patient?.address }}</td>
                      <td class="px-2 py-1">
                        <button
                          @click="showHistory(record.patient.id)"
                          class="text-blue-500 hover:text-white hover:bg-blue-500 border border-blue-500 rounded px-2 py-1 text-xs"
                        >
                          <i class="fa-solid fa-folder-open mr-1"></i> History
                        </button>
                      </td>
                    </tr>
                    <tr v-if="filteredRecords.length === 0">
                      <td colspan="6" class="text-center py-4 text-gray-500">
                        No records found.
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </AuthenticatedLayout>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from "vue";
  import { Head } from "@inertiajs/vue3";
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import { usePage, router } from "@inertiajs/vue3";
  import Swal from "sweetalert2";
  import { Inertia } from "@inertiajs/inertia";
  
  // Extract records from props
  const { records, userRole } = usePage().props;


  
  // Reactive variable for search query
  const searchQuery = ref("");
  
  // Filtered records based on search query
  const filteredRecords = computed(() => {
    const recordsArray = Array.isArray(records) ? records : Object.values(records);
    if (!searchQuery.value) return recordsArray;
    const query = searchQuery.value.toLowerCase();
    return recordsArray.filter((record) => {
        const { patient } = record;
        return (
            (patient?.name?.toLowerCase().includes(query) || "") ||
            (patient?.lname?.toLowerCase().includes(query) || "") ||
            (patient?.contact_no?.toString().toLowerCase().includes(query) || "") ||
            (patient?.email?.toLowerCase().includes(query) || "") ||
            (patient?.address?.toLowerCase().includes(query) || "")
        );
    });
});
  
  // Show patient history
  const showHistory = (id) => {
    Swal.fire({
      title: "View Patient History?",
      text: "You will be redirected to the patient history page.",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Yes, view history!",
      cancelButtonText: "No, cancel!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = `/certificate/${id}/history`;
      }
    });
  };
  </script>
  