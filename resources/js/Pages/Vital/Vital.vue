<template>
    <div>
      <Head title="Vitals" />
  
      <AuthenticatedLayout>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Get Patient Vitals</h2>
        </template>
  
        <!-- Main content area -->
        <div class="py-6">
          <div class="max-w-7xl mx-auto ">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 space-y-6">
  
              <!-- Appointment details section -->
              <div class="mb-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-2">Patient Details</h3>
                <!-- Flex Container for Image and Details -->
                <div class="flex items-start gap-6">
                    <!-- Patient Image -->
                    <div>
                        <img 
                        class="h-32 w-32 rounded-full object-cover" 
                        :src="user?.profile_picture ? `/storage/profile_pictures/${user?.profile_picture}` : '/images/avatar.png'" 
                        alt="Profile Picture"
                        >
                    </div>
                    
                    <!-- Patient Details -->
                    <div class="flex-1">
                        <div class="grid grid-cols-3 text-sm border-gray-300 text-gray-700">
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Patient Last Name:</strong></p>
                                    <p>{{ user?.lname }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Patient First Name:</strong></p>
                                    <p>{{ user?.name }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Patient Middle Name:</strong></p>
                                    <p>{{ user?.mname || 'N/A' }}</p>
                                </div>
                                </div>
                                <div class="grid grid-cols-4 text-sm text-gray-700">
                                <div v-if="user?.course_year" class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Course, and Year:</strong></p>
                                    <p>{{ user?.course_year }}</p>
                                    </div>
                                    <div v-else-if="user?.position" class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Position:</strong></p>
                                    <p>{{ user?.position }}</p>
                                    </div>
                                    <div v-else class="border-[1px] border-gray-300 bg-white p-2">
                                    <p> </p>
                                </div>

                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Date of Birth:</strong></p>
                                    <p>{{ new Date(user?.date_of_birth).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) || 'N/A' }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Age:</strong></p>
                                    <p>{{ user?.age }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Gender:</strong></p>
                                    <p>{{ user?.gender }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <form @submit.prevent="saveDiagnostic" class="space-y-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2"><span class="text-red-500">*</span> Vital Signs</label>
                    <textarea
                        v-model="form.vital_signs"
                        rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Record temperature, blood pressure, pulse, oxygen saturation, etc."
                    ></textarea>
                </div>


                <div class="text-center">
                    <button
                        type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 mt-6 rounded"
                    >
                        Submit Diagnostic
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
import { ref, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia';


const props = defineProps({
  user: {
    type: Object,
    required: true
  }
});

// Form state
const form = useForm({
  patient_id: props.user.id, // Automatically associate with the user
  date: new Date().toISOString().split("T")[0], // Default to today's date
  chief_complaints: "",
  vital_signs: "",
  diagnosis: "",
  management: "",
  status: "pending",
});

// Save function
const saveDiagnostic = () => {
  form.post(route("diagnose.store"), {
    onSuccess: () => {
      Swal.fire("Success", "Diagnostic record saved successfully.", "success");
    },
    onError: () => {
      Swal.fire("Error", "Failed to save diagnostic record.", "error");
    },
  });
};

</script>