<template>
    <div>
    <Head title="Reports" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Record of:{{ record.patient.lname }}, {{ record.patient.name }}</h2>
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
                <main class="flex-grow">
                    <div class="flex flex-col md:flex-row w-full justify-center">
                        <div class="w-full">
                            <div class=" px-16 py-16 rounded-lg relative overflow-hidden">
                                <h1 class="text-center mb-8 font-bold text-xl leading-tight">
                                    Republic of the Philippines
                                    <br />
                                    Kalinga State University
                                    <br />
                                    Bulanao, Tabuk City, Kalinga 
                                    <br />
                                    Health Services Office
                                </h1>
                                <h1 class="text-center underline font-bold text-xl mb-6">MEDICAL CERTIFICATE</h1>
                                <h1 class="text-right text-lg mb-6">Date: <span class="underline">{{ new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' }) }}</span></h1>
                                <p class="mb-4 indent-8">
                                    This is to certify that Mr /Miss <span class="uppercase font-bold underline mx-2">{{ record.patient.name }}, {{ record.patient.lname }}</span> came here at the Clinic on
                                    <span class="uppercase font-bold underline mx-2">
                                        {{ new Date(record?.date).toLocaleDateString('en-US', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            }) || 'N/A' }}
                                    </span>. Due to<span class="uppercase font-bold underline mx-2"> {{ record.chief_complaints }}</span> He / She <span class="uppercase font-bold underline mx-2">{{ record.diagnosis }}</span> 
                                </p>
                                <p class="mb-4 indent-8">This certification is issued for whatever legal intent it may serve.</p>
                                <p class="indent-8 mb-8">Given this {{ new Date().getDate() }} day of {{ new Date().toLocaleString('default', { month: 'long' }) }} {{ new Date().getFullYear() }}</p>
                                <div class="text-right mb-8">
                                    <h1 class="underline text-lg font-bold">Cesaria D. Mendoza, M.D.</h1>
                                    <h1 class="italic">School Physician</h1>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
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
import Swal from "sweetalert2";
import html2pdf from "html2pdf.js";

const { record, userRole, user } = usePage().props;

// Function to export to PDF

function generatePDF() {
  const element = document.getElementById('report-content');
  const options = {
    margin: 0.5,
    filename: 'Medical Certificate.pdf',
    image: { type: 'jpeg' },
    html2canvas: { scale: 1 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
  };

  html2pdf().from(element).set(options).save();
}
</script>