<template>
  <div>
      <Head title="Vitals" />

      <AuthenticatedLayout>
          <template #header>
              <h2 class="font-semibold text-xl text-gray-800 leading-tight">Get Patient Vitals</h2>
          </template>

          <div class="py-6">
              <div class="max-w-7xl mx-auto">
                  <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 space-y-6">
                      <!-- Patient Details -->
                      <div class="mb-4">
                          <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Patient Details</h3>
                          <div class="flex items-start gap-6">
                              <!-- Patient Image -->
                              <div>
                                  <img
                                      class="h-32 w-32 rounded-full object-cover"
                                      :src="user?.profile_picture ? `/storage/profile_pictures/${user?.profile_picture}` : '/images/avatar.png'"
                                      alt="Profile Picture"
                                  />
                              </div>

                              <!-- Patient Info -->
                              <div class="flex-1">
                                  <div class="grid grid-cols-3 text-sm border-gray-300 text-gray-700">
                                      <div class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Last Name:</strong></p>
                                          <p>{{ user?.lname }}</p>
                                      </div>
                                      <div class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>First Name:</strong></p>
                                          <p>{{ user?.name }}</p>
                                      </div>
                                      <div class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Middle Name:</strong></p>
                                          <p>{{ user?.mname || 'N/A' }}</p>
                                      </div>
                                  </div>

                                  <div class="grid grid-cols-4 text-sm text-gray-700">
                                      <div v-if="user?.course_year" class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Course & Year:</strong></p>
                                          <p>{{ user?.course_year }}</p>
                                      </div>
                                      <div v-else-if="user?.position" class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Position:</strong></p>
                                          <p>{{ user?.position }}</p>
                                      </div>

                                      <div class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Date of Birth:</strong></p>
                                          <p>{{ formatDate(user?.date_of_birth) }}</p>
                                      </div>
                                      <div class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Age:</strong></p>
                                          <p>{{ user?.age }}</p>
                                      </div>
                                      <div class="border-[1px] border-gray-300 bg-white p-2">
                                          <p><strong>Sex:</strong></p>
                                          <p>{{ user?.gender }}</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Vitals Form -->
                      <form @submit.prevent="saveDiagnostic" class="space-y-4">
                          <h3 class="text-lg font-medium leading-6 text-gray-900">Vital Signs</h3>

                          <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
                                  <input
                                      v-model="form.weight"
                                      type="number"
                                      class="p-2 w-full text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter weight"
                                  />
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-1">Height (cm)</label>
                                  <input
                                      v-model="form.height"
                                      type="number"
                                      class="p-2 w-full text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter height"
                                  />
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-1">Blood Pressure</label>
                                  <input
                                      v-model="form.blood_pressure"
                                      type="text"
                                      class="p-2 w-full text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="e.g. 120/80 mmHg"
                                  />
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-1">Heart Rate (bpm)</label>
                                  <input
                                      v-model="form.heart_rate"
                                      type="number"
                                      class="p-2 w-full text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter heart rate"
                                  />
                              </div>
                              <div>
                                  <label class="block text-sm font-medium text-gray-700 mb-1">Temperature (°C)</label>
                                  <input
                                      v-model="form.temperature"
                                      type="number"
                                      step="0.1"
                                      class="p-2 w-full text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter temperature"
                                  />
                              </div>
                          </div>

                          <div class="text-center">
                              <button
                                  type="submit"
                                  class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 mt-6 rounded"
                              >
                                  Submit Vitals
                              </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
  user: {
      type: Object,
      required: true
  }
});

// Form state with individual inputs
const form = useForm({
  patient_id: props.user.id,
  date: new Date().toISOString().split("T")[0],
  weight: "",
  height: "",
  blood_pressure: "",
  heart_rate: "",
  temperature: "",
  status: "pending",
});

// Function to save vitals
const saveDiagnostic = () => {
  form.post(route("diagnose.store_vital"), {
      onSuccess: () => {
          Swal.fire("Success", "Vital signs saved successfully.", "success");
      },
      onError: () => {
          Swal.fire("Error", "Failed to save vitals.", "error");
      }
  });
};

// Function to format date properly
const formatDate = (date) => {
  return new Date(date).toLocaleDateString("en-US", { year: "numeric", month: "long", day: "numeric" }) || "N/A";
};
</script>
