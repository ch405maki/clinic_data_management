<template>
    <div>
      <Head title="Update Diagnostic" />
    
      <AuthenticatedLayout>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Diagnose </h2>
        </template>
    
        <div class="py-6">
          <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6 space-y-6">
                <div class="bg-white overflow-hidden sm:rounded-lg p-6">
                <!-- Patient Details Section -->
                <div class="mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Patient Details</h3>
                    
                    <!-- Flex Container for Image and Details -->
                    <div class="flex items-start gap-6">
                    <!-- Patient Image -->
                    <div>
                        <img 
                        class="h-32 w-32 rounded-full object-cover" 
                        :src="record.patient.profile_picture ? `/storage/profile_pictures/${record.patient.profile_picture}` : '/images/avatar.png'" 
                        alt="Profile Picture"
                        >
                    </div>
                    
                    <!-- Patient Details -->
                    <div class="flex-1">
                        <div class="grid grid-cols-3 text-sm border-gray-300 text-gray-700">
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Patient Last Name:</strong></p>
                                    <p>{{ record.patient.lname }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Patient First Name:</strong></p>
                                    <p>{{ record.patient.name }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Patient Middle Name:</strong></p>
                                    <p>{{ record.patient.mname || 'N/A' }}</p>
                                </div>
                                </div>
                                <div class="grid grid-cols-4 text-sm text-gray-700">
                                <div v-if="record.patient.course_year" class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Course, and Year:</strong></p>
                                    <p>{{ record.patient.course_year }}</p>
                                    </div>
                                    <div v-else-if="record.patient.position" class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Position:</strong></p>
                                    <p>{{ record.patient.position }}</p>
                                    </div>
                                    <div v-else class="border-[1px] border-gray-300 bg-white p-2">
                                    <p> </p>
                                </div>

                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong><span class="text-red-500">*</span> Date of Birth:</strong></p>
                                    <p>{{ new Date(record.patient.date_of_birth).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) || 'N/A' }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Age:</strong></p>
                                    <p>{{ record.patient.age }}</p>
                                </div>
                                <div class="border-[1px] border-gray-300 bg-white p-2">
                                    <p><strong>Gender:</strong></p>
                                    <p>{{ record.patient.gender }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

              <!-- Form to update diagnostic record -->
              <form @submit.prevent="saveDiagnostic" class="space-y-4">
                <div>
                  <label for="chief_complaints" class="block text-sm font-medium text-gray-700 mb-2"><span class="text-red-500">*</span> Chief Complaints</label>
                  <textarea
                    v-model="form.chief_complaints"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Describe patient's primary concerns..."
                    required
                  ></textarea>
                </div>
  
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2"><span class="text-red-500">*</span> Vital Signs</label>
                  <textarea
                    v-model="form.vital_signs"
                    rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                    placeholder="Record temperature, blood pressure, pulse, oxygen saturation, etc."
                    readonly
                  ></textarea>
                </div>
  
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2"><span class="text-red-500">*</span> Diagnosis</label>
                  <textarea
                    v-model="form.diagnosis"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter diagnosis based on examination and test results..."
                    required
                  ></textarea>
                </div>
  
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2"><span class="text-red-500">*</span> Medical Treatment</label>
                  <textarea
                    v-model="form.management"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Outline treatment plan, medications, and follow-up instructions..."
                  ></textarea>
                </div>
  
                <div class="text-center">
                  <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 mt-6 rounded"
                  >
                    Submit Record
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
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
  record: Object, // Passed from the backend
});

const form = ref({
  patient_id: props.record.patient_id || '',
  date: props.record.date || '',
  chief_complaints: props.record.chief_complaints || '',
  vital_signs: props.record.vital_signs || '',
  diagnosis: props.record.diagnosis || '',
  management: props.record.management || '',
  status: props.record.status || 'Completed',
});

const saveDiagnostic = () => {
  router.put(`/update-diagnostic/${props.record.id}`, form.value, {
    onSuccess: () => alert('Record updated successfully!'),
  });
};
</script>


  