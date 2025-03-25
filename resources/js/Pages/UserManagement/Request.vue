<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2';

const props = defineProps({
    users: { type: Array, required: true },
});

// Function to update user status
const updateUserStatus = async (userId, status) => {
    try {
        const response = await axios.patch(`/api/users/${userId}/status`, { status });

        // Success Message
        Swal.fire({
            title: "Success",
            text: `User status updated to ${status}`,
            icon: "success",
        });

        // Reload Page or Update UI (simplified)
        location.reload();
    } catch (error) {
        console.error("Error updating user status:", error);
        Swal.fire({
            title: "Error",
            text: "Failed to update user status.",
            icon: "error",
        });
    }
};
</script>

<template>
    <Head title="User Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Requests</h2>
        </template>

        <div class="flex flex-col min-h-screen bg-gray-100 py-4">
            <main class="flex-grow">
                <div class="max-w-7xl mx-auto">
                    <div class="w-full p-4 bg-white shadow-lg rounded-lg">
                        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-3 text-left text-sm font-semibold text-gray-700">Full Name</th>
                                    <th class="p-3 text-left text-sm font-semibold text-gray-700">Contact #</th>
                                    <th class="p-3 text-left text-sm font-semibold text-gray-700">Email</th>
                                    <th class="p-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                    <th class="p-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                                <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                                    <td class="p-3 text-gray-800">{{ user.name }}</td>
                                    <td class="p-3 text-gray-800">{{ user.contact_no || 'N/A' }}</td>
                                    <td class="p-3 text-gray-800">{{ user.email }}</td>
                                    <td class="p-3 font-semibold" :class="{
                                        'text-yellow-500': user.status === 'pending',
                                        'text-green-500': user.status === 'active',
                                        'text-red-500': user.status === 'inactive'
                                    }">
                                        {{ user.status }}
                                    </td>
                                    <td class="p-3">
                                        <div class="flex justify-center space-x-3">
                                            <!-- Approve Button -->
                                            <button
                                                v-if="user.status === 'pending'"
                                                @click="updateUserStatus(user.id, 'active')"
                                                class="px-3 py-1 text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-md">
                                                Approve
                                            </button>
                                            
                                            <!-- Disapprove Button -->
                                            <button
                                                v-if="user.status !== 'inactive'"
                                                @click="updateUserStatus(user.id, 'inactive')"
                                                class="px-3 py-1 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md">
                                                Disapprove
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>
