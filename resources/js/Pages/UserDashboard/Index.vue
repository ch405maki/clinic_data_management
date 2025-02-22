<template>
    <div>
        <Head title="Reports" />
        <UserLayout>
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6">
                <!-- First column: User Profile -->
                <div class="sm:col-span-3 mt-6 bg-white p-4 rounded-lg shadow-md">
                    <img 
                        class="h-20 w-20 rounded-full mx-auto block" 
                        :src="user.profile_picture ? `/storage/profile_pictures/${$page.props.auth.user.profile_picture}` : '/images/avatar.png'" 
                        alt="Profile Picture"
                    >
                    <h3 class="text-lg font-semibold mb-4 text-center">{{ user?.name }} {{ user?.lname }}</h3>
                    <p class="text-sm mb-2 text-gray-600"><strong>DOB:</strong> {{ new Date(user?.date_of_birth).toLocaleDateString('en-US') || 'N/A' }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Age:</strong> {{ user?.age }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Gender:</strong> {{ user?.gender }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Status:</strong> {{ user?.civil_status }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Address:</strong> {{ user?.address || 'n/a' }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Contact:</strong> {{ user?.contact_no || 'n/a' }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Course & Year:</strong> {{ user?.course_year || 'n/a' }}</p>
                    <p class="text-sm mb-2 text-gray-600"><strong>Position:</strong> {{ user?.position || 'n/a' }}</p>
                </div>

                <!-- Second column: Reports Table -->
                <div class="py-6 sm:col-span-9">
                    <div class="mx-auto space-y-6">
                        <div class="bg-white shadow-sm sm:rounded-lg p-3 rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full text-sm">
                                    <thead class="border border-gray-300">
                                        <tr class="bg-gray-100">
                                            <th class="px-4 py-2 text-left">Date</th>
                                            <th class="px-4 py-2 text-left">Complaints</th>
                                            <th class="px-4 py-2 text-left">Vital Sign</th>
                                            <th class="px-4 py-2 text-left">Diagnosis</th>
                                            <th class="px-4 py-2 text-left">Management</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        <!-- Display records if available -->
                                        <tr 
                                            v-if="records.length > 0"
                                            v-for="(record, index) in records"
                                            :key="index"
                                            class="border border-gray-200 hover:bg-gray-100"
                                        >
                                            <td class="px-4 py-2">{{ new Date(record?.date).toLocaleDateString('en-US') || 'N/A' }}</td>
                                            <td class="px-4 py-2 border-l border-gray-200">{{ record.chief_complaints }}</td>
                                            <td class="px-4 py-2 border-l border-gray-200">{{ record.vital_signs }}</td>
                                            <td class="px-4 py-2 border-l border-gray-200">{{ record.diagnosis }}</td>
                                            <td class="px-4 py-2 border-l border-gray-200">{{ record.management }}</td>
                                        </tr>

                                        <!-- No records found -->
                                        <tr v-else>
                                            <td colspan="5" class="text-center py-4 text-gray-500 text-lg font-medium">
                                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> 
                                                No records found
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </UserLayout>
    </div>
</template>


<script setup>
import { ref, onMounted, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import UserLayout from '@/Layouts/UserLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import Swal from "sweetalert2";
import html2pdf from "html2pdf.js";

const { records, userRole, user } = usePage().props;

// Function to export to PDF

// Function to generate PDF
    function generatePDF() {
    const element = document.querySelector('.overflow-x-auto');
    const options = {
        margin: 0.5,
        filename: 'Individual Treatment Record.pdf',
        image: { type: 'jpeg' },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' },
    };

    html2pdf().from(element).set(options).save();
    }
</script>