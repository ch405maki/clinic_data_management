<template>
    <div>
    <Head title="Reports" />
    <UserLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Record of: {{ user?.lname }}, {{ user?.name }}</h2>
                <div class="flex items-center gap-4">
                    <!-- Export PDF Button -->
                    <button
                        @click="generatePDF"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none"
                    >
                        Export to PDF
                    </button>
                </div>
            </div>
        </template>
        
        <div class="py-6">
            <div class="mx-auto space-y-6 " id="report-content">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 rounded-lg">
                <div class="overflow-x-auto">
                    <div class="grid grid-cols-12 border-gray-300 bg-white shadow-sm">
                        <!-- Logo -->
                        <div class="col-span-2 flex items-center justify-center border-[1px] border-gray-300  bg-white p-4">
                            <img src="/images/logo.png" class="h-24 w-auto" alt="KSU Logo">
                        </div>

                        <!-- University Information -->
                        <div class="col-span-6 text-center font-bold border-[1px] border-gray-300  bg-white p-4">
                            <h2 class="text-lg">Kalinga State University</h2>
                            <p class="text-sm">Bulanao, Tabuk City</p>
                            <p class="text-sm">Health Services Unit Medical Section</p>
                            <p class="text-lg uppercase">Individual Treatment Record</p>
                            <p class="text-sm"></p>
                        </div>

                        <!-- Sub-column 1 -->
                        <div class="col-span-2 border-[1px] border-gray-300  bg-white">
                            <div class="grid divide-y-2 divide-gray-300">
                            <div class="p-[3px]">Doc. Ref. No.</div>
                            <div class="p-[3px]">Effectivity Date:</div>
                            <div class="p-[3px]">Revision No.</div>
                            <div class="p-[3px]">Page No.</div>
                            </div>
                        </div>

                        <!-- Sub-column 2 -->
                        <div class="col-span-2 border-[1px] border-gray-300  bg-white">
                            <div class="grid divide-y-2 divide-gray-300">
                            <div class="p-[3px]">KSU-OHS MFO4</div>
                            <div class="p-[3px]">DECEMBER 2018</div>
                            <div class="text-white p-[3px]">none</div>
                            <div class="p-[3px]">Page 1 of 1</div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 text-sm border-gray-300  text-gray-700">
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.lname }}</strong></p>
                    <p>Last Name</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.name }}</strong></p>
                    <p>FirstName</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.mname || 'N/A' }}</strong></p>
                    <p>Middle Name</p>
                    </div>
                </div>
                <div class="grid grid-cols-4 text-sm text-gray-700">
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.course_year || 'N/A' }}</strong></p>
                    <p>If Student, Course, and Year</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ new Date(user?.date_of_birth).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) || 'N/A' }}</strong></p>
                    <p>Date of Birth</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.age }}</strong></p>
                    <p>Age</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.gender }}</strong></p>
                    <p>Gender</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 text-sm text-gray-700">
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.position || 'N/A' }}</strong></p>
                    <p>If Employee, Position</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.civil_status }}</strong></p>
                    <p>Civil Status</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 text-sm text-gray-700">
                    <div class="border-[1px] col-span-2 border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.address || 'N/A' }}</strong></p>
                    <p>Home Address.</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.contact_no || 'N/A' }}</strong></p>
                    <p>Contact no.</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 text-sm text-gray-700">
                    <div class="border-[1px] col-span-2 border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.emergency_name || 'N/A' }}</strong></p>
                    <p>In case of emergency, notify</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.emergency_contact_no || 'N/A' }}</strong></p>
                    <p>Contact no.</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 text-sm text-gray-700">
                    <div class="border-[1px] col-span-2 border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.emergency_address || 'N/A' }}</strong></p>
                    <p>Address</p>
                    </div>
                    <div class="border-[1px] border-gray-300  bg-white  p-[3px]">
                    <p><strong>{{ user?.emergency_relationship || 'N/A' }}</strong></p>
                    <p>Relationship</p>
                    </div>
                </div>
                    <table class="table-auto w-full ">
                    <thead class="border-[1px] border-gray-300 ">
                        <tr class="bg-gray-100 rounded-lg">
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">Chief Complaints</th>
                        <th class="px-4 py-2 text-left">Vital Sign</th>
                        <th class="px-4 py-2 text-left">Diagnosis</th>
                        <th class="px-4 py-2 text-left">Management</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr v-for="(record, index) in records" :key="index" class="border border-gray-200 hover:bg-gray-100 text-sm">
                            <td class="px-4 py-2 ">{{ new Date(record?.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) || 'N/A' }}</td>
                            <td class="px-4 py-2 border-l border-gray-200 ">{{ record.chief_complaints }}</td> 
                            <td class="px-4 py-2 border-l border-gray-200">{{ record.vital_signs }}</td>
                            <td class="px-4 py-2 border-l border-gray-200">{{ record.diagnosis }}</td>
                            <td class="px-4 py-2 border-l border-gray-200">{{ record.management }}</td>
                        </tr>
                    </tbody>
                    </table>
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