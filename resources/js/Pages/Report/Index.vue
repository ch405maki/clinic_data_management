<template>
    <div>
      <Head title="Reports" />
      <AuthenticatedLayout>
        <template #header>
          <div class="flex justify-between items-center">
            <!-- Heading Section -->
            <div class="flex items-center space-x-4 w-full">
              <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reports
              </h2>
  
              <!-- Position Filter -->
              <select
                v-if="role === 'dentist'"
                v-model="selectedPosition"
                class="block w-1/4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              >
                <option value="">All Positions</option>
                <option value="Student">Student</option>
                <option value="Employee">Employee</option>
              </select>
  
              <!-- Campus Filter -->
              <select
                v-if="role === 'dentist'"
                v-model="selectedCampus"
                class="block w-1/4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              >
                <option value="">All Campuses</option>
                <option value="Bulanao">Bulanao</option>
                <option value="Dagupan">Dagupan</option>
                <option value="Rizal">Rizal</option>
              </select>
  
              <!-- Service Filter -->
              <select
                v-model="selectedSortOption"
                @change="handleSort"
                class="block w-1/4 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              >
                <option value="">All Services</option>
                <option value="Dental Extraction">Dental Extraction</option>
                <option value="Dental Restoration">Dental Restoration</option>
                <option value="Oral Prophylaxis">Oral Prophylaxis</option>
                <option value="Complete Dose of Medicine">Complete Dose of Medicine</option>
                <option value="Consultation or Oral Health Problem">Consultation or Oral Health Problem</option>
                <option value="Other Services">Other Services</option>
              </select>
            </div>
  
            <!-- Search Input -->
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search here..."
              class="block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
          </div>
        </template>
  
        <div class="py-6">
          <div class="mx-auto space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 rounded-lg">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead>
                    <tr class="bg-gray-200">
                      <th class="px-4 py-2 text-left" v-if="isSmScreen || !isSmScreen">Date</th>
                      <th class="px-4 py-2 text-left" v-if="!isSmScreen">Full Name</th>
                      <th class="px-4 py-2 text-left" v-if="!isSmScreen">Diagnosis</th>
                      <th class="px-4 py-2 text-left" v-if="!isSmScreen">Remarks</th>
                      <th class="px-4 py-2 text-left" v-if="!isSmScreen">Service</th>
                      <th class="px-4 py-2" v-if="isSmScreen || !isSmScreen">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-gray-700">
                    <tr
                      v-for="appointment in filteredAppointments"
                      :key="appointment.id"
                      class="border-b border-gray-200 hover:bg-gray-100"
                    >
                      <td class="px-4 py-2">{{ formatDate(appointment.appointment_date) }}</td>
                      <template v-if="!isSmScreen">
                        <td class="px-4 py-2">{{ appointment.student?.name || 'No student' }}</td>
                        <td class="px-4 py-2">{{ appointment.diagnostic?.description || 'No description available' }}</td>
                        <td class="px-4 py-2">{{ appointment.diagnostic?.remarks || 'No remarks available' }}</td>
                        <td class="px-4 py-2">{{ appointment.diagnostic?.service_rendered || 'No service available' }}</td>
                      </template>
                      <td v-if="role === 'dentist'" class="px-4 py-2 text-center">
                        <button
                          @click="showData(appointment.student_id)"
                          class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                        >
                          View Dental records
                        </button>
                      </td>
                      <td v-if="role === 'student'" class="px-4 py-2 text-center">
                        <button
                          @click="handleAction(appointment.id)"
                          class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
                        >
                          View
                        </button>
                      </td>
                    </tr>
                    <tr v-if="!filteredAppointments.length">
                      <td colspan="6" class="text-center py-4 text-gray-500">No data found</td>
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
  import { ref, onMounted, computed } from 'vue';
  import { Head } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { usePage, router } from '@inertiajs/vue3';
  import { toRaw } from 'vue';
  
  const { appointments, role } = usePage().props;
  let results = Array.isArray(toRaw(appointments)) ? toRaw(appointments) : [];
  
  console.log("Type of appointments:", typeof appointments);
  console.log("Raw appointments:", toRaw(appointments));
  
  
  const searchQuery = ref('');
  const selectedPosition = ref('');
  const selectedCampus = ref('');
  const selectedSortOption = ref('');
  const isSmScreen = window.innerWidth < 640;
  
  // Filtered Appointments Logic
  const filteredAppointments = computed(() => {
      // Convert the `appointments` object into an array
      let results = Object.values(toRaw(appointments)); // Use Object.values() to extract values as an array
  
      // Apply filters
      if (searchQuery.value) {
          results = results.filter((appointment) =>
              [
                  appointment.student?.name,
                  appointment.diagnostic?.description,
                  appointment.diagnostic?.service_rendered,
                  formatDate(appointment.appointment_date),
              ]
                  .join(' ')
                  .toLowerCase()
                  .includes(searchQuery.value.toLowerCase())
          );
      }
  
      if (selectedPosition.value) {
          results = results.filter((appointment) => appointment.student?.position === selectedPosition.value);
      }
  
      if (selectedCampus.value) {
          results = results.filter((appointment) => appointment.student?.campus === selectedCampus.value);
      }
  
      if (selectedSortOption.value) {
          results = results.filter((appointment) => appointment.diagnostic?.service_rendered === selectedSortOption.value);
      }
  
      return results;
  });
  
  const handleAction = (appointmentId) => {
    router.get(route('reports.show', appointmentId));
  };
  
  const showData = (appointmentId) => {
    router.get(route('reportsData.show', appointmentId));
  };
  
  const formatDate = (dateString) => {
    const date = new Date(dateString);
    const options = { month: 'long', day: 'numeric', year: 'numeric' };
    return date.toLocaleDateString('en-US', options);
  };
  </script>
  