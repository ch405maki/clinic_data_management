<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    mname: user.mname,
    lname: user.lname,
    email: user.email,
    course_year: user.course_year,
    date_of_birth: user.date_of_birth,
    age: user.age,
    gender: user.gender,
    position: user.position,
    civil_status: user.civil_status,
    address: user.address,
    contact_no: user.contact_no,
    emergency_name: user.emergency_name,
    emergency_relationship: user.emergency_relationship,
    emergency_address: user.emergency_address,
    emergency_contact_no: user.emergency_contact_no,
    role: user.role,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        
    </section>
    <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <!-- Name -->
            <div class="grid grid-cols-3 gap-4">
                <!-- First Name -->
                <div>
                    <InputLabel for="name" value="First Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <!-- Middle Name -->
                <div>
                    <InputLabel for="mname" value="Middle Name" />
                    <TextInput
                        id="mname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.mname"
                        autocomplete="mname"
                    />
                    <InputError class="mt-2" :message="form.errors.mname" />
                </div>

                <!-- Last Name -->
                <div>
                    <InputLabel for="lname" value="Last Name" />
                    <TextInput
                        id="lname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lname"
                        autocomplete="lname"
                    />
                    <InputError class="mt-2" :message="form.errors.lname" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- Email -->
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Course Year -->
                <div v-if="user.role === 'Patient'">
                    <InputLabel for="course_year" value="Course Year" />
                    <TextInput
                        id="course_year"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.course_year"
                        autocomplete="course_year"
                    />
                    <InputError class="mt-2" :message="form.errors.course_year" />
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <!-- Date of Birth -->
                <div>
                    <InputLabel for="date_of_birth" value="Date of Birth" />
                    <TextInput
                        id="date_of_birth"
                        type="date"
                        class="mt-1 block w-full"
                        v-model="form.date_of_birth"
                        autocomplete="date_of_birth"
                    />
                    <InputError class="mt-2" :message="form.errors.date_of_birth" />
                </div>

                <!-- Age -->
                <div>
                    <InputLabel for="age" value="Age" />
                    <TextInput
                        id="age"
                        type="number"
                        class="mt-1 block w-full"
                        v-model="form.age"
                        autocomplete="age"
                    />
                    <InputError class="mt-2" :message="form.errors.age" />
                </div>

                <!-- Gender -->
                <div>
                    <InputLabel for="gender" value="Gender" />
                    <select
                        id="gender"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        v-model="form.gender"
                        autocomplete="gender"
                    >
                        <option value="" disabled>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <!-- Civil Status -->
                <div>
                    <InputLabel for="civil_status" value="Civil Status" />
                    <select
                        id="civil_status"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        v-model="form.civil_status"
                        autocomplete="civil_status"
                    >
                        <option value="" disabled>Select Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.civil_status" />
                </div>
                <!-- Contact No. -->
                <div class="col-span-2">
                    <InputLabel for="contact_no" value="Contact No." />
                    <TextInput
                        id="contact_no"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.contact_no"
                        autocomplete="contact_no"
                    />
                    <InputError class="mt-2" :message="form.errors.contact_no" />
                </div>
            </div>

            <div v-if="user.role === 'Patient'">
                <!-- Emergency Contact -->
                <div>
                    <InputLabel for="emergency_name" value="Emergency Name" />
                    <TextInput
                        id="emergency_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.emergency_name"
                        autocomplete="emergency_name"
                    />
                    <InputError class="mt-2" :message="form.errors.emergency_name" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-2 mb-2">
                    <!-- Emergency Relationship -->
                    <div>
                        <InputLabel for="emergency_relationship" value="Emergency Relationship" />
                        <TextInput
                            id="emergency_relationship"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.emergency_relationship"
                            autocomplete="emergency_relationship"
                        />
                        <InputError class="mt-2" :message="form.errors.emergency_relationship" />
                    </div>
                    
                    <!-- Emergency Contact No. -->
                    <div>
                        <InputLabel for="emergency_contact_no" value="Emergency Contact No." />
                        <TextInput
                            id="emergency_contact_no"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.emergency_contact_no"
                            autocomplete="emergency_contact_no"
                        />
                        <InputError class="mt-2" :message="form.errors.emergency_contact_no" />
                    </div>
                </div>

                <!-- Emergency Address -->
                <div>
                    <InputLabel for="emergency_address" value="Emergency Address" />
                    <TextInput
                        id="emergency_address"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.emergency_address"
                        autocomplete="emergency_address"
                    />
                    <InputError class="mt-2" :message="form.errors.emergency_address" />
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Update Profile</PrimaryButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Updated.</p>
                </Transition>
            </div>
        </form>
</template>
