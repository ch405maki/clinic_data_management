<template>
  <div class=" min-h-screen bg-gray-100">
    <div class="h-full">
      <div class="min-h-full">
        <!-- When the mobile menu is open, add `overflow-hidden` to the `body` element to prevent double scrollbars -->
        <header class="bg-white shadow-sm lg:static lg:overflow-y-visible" :class="{ 'fixed inset-0 z-40 overflow-y-auto': isMenuOpen }">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative flex justify-between lg:gap-8 xl:grid xl:grid-cols-12">
              <!-- Logo Section -->
              <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
                <div class="flex flex-shrink-0 items-center">
                  <div class="p-2.5 mt-1 flex items-center">
                  <Link class="flex items-center">
                    <img src="/images/logo.png" alt="Image Logo" class="max-w-full h-full max-h-8 mr-2 w-4 transition-transform duration-300 transform hover:scale-105">
                  </Link>
                  <div>
                    <div class="text-invicta uppercase font-bold text-gray-700  text-sm tracking-wide leading-tight">Clinic Data Management System</div>
                    <div class="text-invicta font-bold text-gray-700 text-xs tracking-wide leading-tight">Kalinga State University Health Service</div>
                  </div>
                </div>
                </div>
              </div>
              <!-- Search Section -->
              <div class="min-w-0 flex-1 md:px-8 lg:py-2 xl:col-span-6">
                <div class="flex items-center px-6 py-4 md:mx-auto md:max-w-3xl lg:mx-0 lg:max-w-none xl:px-0">
                  
                </div>
              </div>

              <!-- Mobile Menu Button -->
              <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
                <button type="button" class="-mx-2 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-500" @click="toggleMenu">
                  <span class="sr-only">Open menu</span>
                  <svg class="h-6 w-6" v-if="!isMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                  </svg>
                  <svg class="h-6 w-6" v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
                </button>
              </div>

              <!-- Desktop Actions -->
              <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
                <a v-if="user.role === 'dentist' || user.role === 'staff'" href="#" class="ml-5 flex-shrink-0 relative rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                  <span class="sr-only">View notifications</span>
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                  </svg>
                  
                  <!-- Sidebar Length Notification -->
                  <span class="absolute top-0 mt-[1px] right-0 inline-flex items-center justify-center w-3 h-3 p-3 text-sm font-medium text-red-800 bg-red-100 rounded-full transform translate-x-1/2 -translate-y-1/2">
                    {{ sidebar.length }}
                  </span>
                </a>
                <div class="relative ml-5 flex-shrink-0">
                  <button type="button" class="flex rounded-full bg-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2" @click="toggleProfileMenu">
                      <span class="sr-only">Open user menu</span>
                      <img 
                          class="h-8 w-8 rounded-full" 
                          :src="user.profile_picture ? `/storage/profile_pictures/${$page.props.auth.user.profile_picture}` : '/images/avatar.png'" 
                          alt="">
                  </button>
                  <!-- Profile dropdown -->
                  <div v-if="isProfileMenuOpen" @click.away="isProfileMenuOpen = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <a href="#" class="block py-2 px-4 text-sm text-gray-700">Hi, {{ user.name }}</a>
                    <a :href="route('profile.edit')" class="block py-2 px-4 text-sm text-gray-700">Your Profile</a> 
                    <a :href="route('logout')"  as="button" class="block py-2 px-4 text-sm text-gray-700">Sign out</a>
                  </div>
                </div>
                <p class="ml-2 text-invicta uppercase font-bold text-gray-700 text-sm tracking-wide leading-tight">Hi, {{ user.name }}</p>
              </div>
            </div>
          </div>

          <!-- Mobile Menu -->
          <nav v-if="isMenuOpen" class="lg:hidden" aria-label="Global" @click.away="isMenuOpen = false">
            <div class="mx-auto max-w-3xl space-y-1 px-2 pt-2 pb-3 sm:px-4">
              <!-- admin -->
              <div v-if="user.role === 'Doctor' ">
                <a :href="route ('dashboard')" class="text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Dashboard</a>
                <a :href="route('diagnose.index')" class="text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Diagnose</a>
                <a :href="route ('certificate.index')" class="text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Med. Certificate</a>
                <a :href="route ('report.index')" class="text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Report</a>
                </div>
              <!-- nurse -->
              <div v-if="user.role === 'Nurse'">
                <a :href="route ('dashboard')" class="text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Dashboard</a>
                <a :href="route ('vital.index')"class="border-t text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Vital's</a>
                <a :href="route ('patient.index')"class="border-t text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Manage Patient's</a>
                <a :href="route ('report.index')" class="border-t text-gray-900 block rounded-md py-2 px-3 text-base font-medium">Reports</a>
              </div>
              <!-- patient -->
              <div v-if="user.role === 'Patient'">
                <a :href="route ('dashboard')" class="text-gray-900 block rounded-md py-2 px-3 text-base font-medium">My Record</a>
              </div>
              <div class="mt-8 border-t" aria-labelledby="account-headline">
                <a :href="route('profile.edit')" class="hover:bg-gray-50 text-gray-500 hover:text-gray-600 block rounded-md py-2 px-3 text-base font-medium">Profile</a>
                <a :href="route('logout')" class="hover:bg-gray-50 block text-gray-500 hover:text-gray-600 rounded-md py-2 px-3 text-base font-medium">Sign out</a>
              </div>
            </div>
          </nav>
        </header>
        <div class="py-10">
        <div class="mx-auto max-w-3xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-12 lg:gap-8 lg:px-8">
          <div class="hidden lg:col-span-3 lg:block xl:col-span-2 ">
            <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
              <div class="space-y-2 pb-8">
                <!-- Dashboard -->
                <div v-if="user.role === 'Patient'">
                  <a :href="route ('dashboard')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-house-chimney mr-2 w-4"></i>
                    <span class="truncate">My Record</span>
                  </a>
                </div>
                <div v-if="user.role != 'Patient'">
                  <a :href="route ('dashboard')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-house-chimney mr-2 w-4"></i>
                    <span class="truncate">Dashboard</span>
                  </a>
                  <div v-if="user.role === 'Nurse'">
                    <a :href="route('vital.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                      <i class="fa-solid fa-notes-medical mr-2 w-4"></i>
                      <span class="truncate">Vital Sign</span>
                    </a>
                    <a :href="route ('report.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                      <i class="fa-solid fa-folder-open mr-2 w-4"></i>
                      <span class="truncate">Reports</span>
                    </a>
                  </div>
                  <div v-if="user.role === 'Doctor'">
                    <a :href="route('diagnose.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                      <i class="fa-solid fa-notes-medical mr-2 w-4"></i>
                      <span class="truncate">Diagnose</span>
                    </a>
                    <a :href="route ('certificate.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                      <i class="fa-solid fa-prescription mr-2 w-4"></i>
                      <span class="truncate">Medical Cerificate</span>
                    </a>
                    <a :href="route ('report.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                      <i class="fa-solid fa-folder-open mr-2 w-4"></i>
                      <span class="truncate">Reports</span>
                    </a>
                  </div>
                </div>

                <!-- User Management Links -->
                <div v-if="user.role === 'Admin'">
                  <a :href="route('user.request')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-users-gear mr-2 w-4"></i>
                    <span class="truncate">User Request</span>
                  </a>
                  <div class="border-t border-gray-300 pt-4"></div>
                  <!-- Manage Users Section -->
                  <div class="text-invicta uppercase font-bold text-gray-700 text-xs tracking-wide leading-tight ml-[12px]">Manage Users</div>
                  <!-- <a :href="route('doctor.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-user-doctor mr-2 w-4"></i>
                    <span class="truncate">Doctors</span>
                  </a> -->
                  <a :href="route('doctor.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-user-nurse mr-2 w-4"></i>
                    <span class="truncate">Doctor</span>
                  </a>
                  <a :href="route('nurse.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-user-nurse mr-2 w-4"></i>
                    <span class="truncate">Nurses</span>
                  </a>
                  <a :href="route('patient.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-users mr-2 w-4"></i>
                    <span class="truncate">Patients</span>
                  </a>
                </div>
                <div v-if="user.role === 'Nurse'">
                  <div class="border-t border-gray-300 pt-4"></div>
                  <!-- Manage Users Section -->
                  <div class="text-invicta uppercase font-bold text-gray-700 text-xs tracking-wide leading-tight ml-[12px]">Manage Users</div>
                  <a :href="route('patient.index')" class="flex items-center px-3 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                    <i class="fa-solid fa-users mr-2 w-4"></i>
                    <span class="truncate">Patients</span>
                  </a>
                </div>

                <!-- Profile and Logout Section -->
                <div class="">
                  <div class="border-t border-gray-300 pt-4"></div>
                  <div class="text-invicta uppercase font-bold text-gray-700 text-xs tracking-wide leading-tight ml-[12px]">Account</div>
                  <div class="mt-3" aria-labelledby="account-headline">
                    <a :href="route('profile.edit')" class="hover:bg-gray-50 text-gray-500 hover:text-gray-600 block rounded-md py-2 px-3 text-base font-medium">Profile</a>
                    <a :href="route('logout')" class="hover:bg-gray-50 block text-gray-500 hover:text-gray-600 rounded-md py-2 px-3 text-base font-medium">Sign out</a>
                  </div>
                </div>
              </div>
            </nav>
          </div>
          <main class="lg:col-span-9 xl:col-span-10">
            <header v-if="$slots.header" class="">
            <div class="max-w-7xl mx-auto py-4 px-4 mx-10 sm:px-6 lg:px-8 rounded-lg bg-white shadow">
            <slot name="header" />
            </div>
            </header>
            <div>
              <slot />
            </div>
          </main>
        </div>
        <Footer />
      </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';  
import { Link } from '@inertiajs/vue3';
import Footer from './Partials/Footer.vue';

// State management using ref for menu visibility
const isMenuOpen = ref(false);
const isProfileMenuOpen = ref(false);

const logout = () => {
  Inertia.post(route('logout'));
};

// Methods to toggle the menus
const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const toggleProfileMenu = () => {
  isProfileMenuOpen.value = !isProfileMenuOpen.value;
};

const sidebar = ref([]); // Store banners as an array

  const FetchSidebar = async () => {
    try {
      const response = await fetch('/sidebar');
      sidebar.value = await response.json(); // Fetch the data as an array
    } catch (error) {
      console.error('Error fetching sidebar:', error);
    }
  };

onMounted(FetchSidebar);

// Ref to manage the visibility of the dropdown
const showingNavigationDropdown = ref(false);

// Ref to manage the header class
const headerClass = ref('bg-white shadow pt-16');

// Function to update the header class based on screen size
const updateHeaderClass = () => {
  if (window.innerWidth >= 640) {
    headerClass.value = 'bg-white shadow';
  } else {
    headerClass.value = 'bg-white shadow pt-16';
  }
};

// Add event listener on mount
onMounted(() => {
  updateHeaderClass();
  window.addEventListener('resize', updateHeaderClass);
});

// Remove event listener before unmount
onBeforeUnmount(() => {
  window.removeEventListener('resize', updateHeaderClass);
});

// Use Inertia's usePage hook to access the page props
const { props } = usePage();
const user = props.auth.user;

// Computed property to check if the user is a student
const isStudent = computed(() => {
  return user.role === 'student';
});
</script>

<style scoped>
.nav-link {
  color: white;
}

/* Tailwind CSS classes for fixed navigation */
.fixed-nav {
  @apply sticky top-0 z-50;
}

/* Media query for mobile devices */
@media (max-width: 640px) {
  .fixed-nav {
    @apply fixed w-full;
  }
}
</style>