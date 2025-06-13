<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import html2pdf from 'html2pdf.js'

const props = defineProps({ referral: Object })

function fmt(ds) {
  return new Date(ds).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  })
}

/* reference to the section we want to print */
const certRef = ref(null)

/* generate PDF */
function printPdf() {
  const options = {
    margin:       10,
    filename:     `referral-${props.referral.referred.lname}.pdf`,
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 2 },
    jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
  }

  html2pdf().set(options).from(certRef.value).save()
}
</script>

<template>
  <Head title="Medical Referral" />

  <AuthenticatedLayout>
    <!-- HEADER SLOT -->
    <template #header>
      <div class="flex items-center justify-between gap-4 flex-wrap">
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Referral Certificate</h1>
          <p class="text-sm text-gray-500">Issued by the Health Services Unit</p>
        </div>

        <div class="flex items-center gap-3 space-x-2">
          <Link
            :href="route('referrals.index')"
            class="text-sm hover:underline bg-rose-500 py-2 px-4 text-white rounded"
          >
            ← Back
          </Link>

          <!-- PRINT PDF BUTTON -->
          <button
            @click="printPdf"
            class="bg-emerald-600 text-white text-sm px-4 py-2 rounded hover:bg-emerald-700"
          >
            Print PDF
          </button>
        </div>
      </div>
    </template>

    <!-- CERTIFICATE SECTION -->
    <main
      ref="certRef"
      class="py-12 px-12 mt-6 max-w-full mx-auto bg-white rounded shadow text-gray-900"
    >
      <!-- University Header -->
      <div class="flex items-center justify-center mr-[85px] mb-8">
        <img src="/images/logo.png" class="h-20 w-auto mr-4" alt="KSU Logo" />
        <h1 class="text-center font-bold text-lg leading-tight">
          Republic of the Philippines<br />
          Kalinga State University<br />
          Bulanao, Tabuk City, Kalinga<br />
          Health Services Office
        </h1>
      </div>

      <!-- Date -->
      <div class="text-right mb-8 text-sm">
        Date: <span class="underline">{{ fmt(referral.created_at) }}</span>
      </div>

      <!-- Body -->
      <div class="text-justify text-[17px] leading-relaxed space-y-6">
        <p class="indent-8">
          This is to formally refer
          <span class="font-bold uppercase underline">{{ referral.referred.name }} {{ referral.referred.lname }}</span>
          to the appropriate health facility or specialist for further medical attention
          and/or evaluation.
        </p>

        <p class="indent-8">
          <span class="font-semibold">Referral Note:</span>
          <span class="whitespace-pre-wrap">{{ referral.notes || '— No notes provided —' }}</span>
        </p>

        <p class="indent-8">
          This referral is issued upon request for appropriate action and assistance,
          as may be deemed necessary.
        </p>

        <p class="indent-8">
          Issued this {{ fmt(referral.created_at) }} at the Health Services Unit,
          Kalinga State University.
        </p>
      </div>

      <!-- Signature -->
      <div class="text-right mt-12">
        <h1 class="font-bold underline text-lg">{{ referral.referrer.name }} {{ referral.referrer.lname }}</h1>
        <p class="italic text-sm">
          License No.: {{ referral.referrer.license || 'N/A' }}
        </p>
        <p class="text-sm text-gray-600">University Doctor</p>
      </div>
    </main>
  </AuthenticatedLayout>
</template>
