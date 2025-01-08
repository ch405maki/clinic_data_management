
<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="flex justify-center mb-8">
            <Link href="/"> 
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <form @submit.prevent="submit">
            <!-- Name Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    autofocus
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Name Here..."
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Middle Name Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="mname" value="Middle Name" />
                <TextInput
                    id="mname"
                    v-model="form.mname"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Middle Name Here..."
                />
            </div>

            <!-- Last Name Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="lname" value="Last Name" />
                <TextInput
                    id="lname"
                    v-model="form.lname"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Last Name Here..."
                />
                <InputError class="mt-2" :message="form.errors.lname" />
            </div>

            <!-- Email Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    required
                    type="email"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Email Here..."
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            
            <!-- Course Year Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="course_year" value="Course Year if Student" />
                <TextInput
                    id="course_year"
                    v-model="form.course_year"
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Course Year Here..."
                />
                <InputError class="mt-2" :message="form.errors.course_year" />
            </div>

            <!-- Date of Birth Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="date_of_birth" value="Date of Birth" />
                <TextInput
                    id="date_of_birth"
                    v-model="form.date_of_birth"
                    required
                    type="date"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Date of Birth Here..."
                />
                <InputError class="mt-2" :message="form.errors.date_of_birth" />
            </div>

            <!-- Age Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="age" value="Age" />
                <TextInput
                    id="age"
                    v-model="form.age"
                    required
                    type="number"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Age Here..."
                />
                <InputError class="mt-2" :message="form.errors.age" />
            </div>

            <!-- Gender Input -->
            <div class="sm:col-span-12 mt-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select
                    id="gender"
                    v-model="form.gender"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-lg"
                >
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <!-- Position Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="position" value="Position if Employed" />
                <TextInput
                    id="position"
                    v-model="form.position"
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Position Here..."
                />
            </div>

            <div class="sm:col-span-12 mt-4">
                <label for="civil_status" class="block text-sm font-medium text-gray-700">Civil Status</label>
                <select
                    id="civil_status"
                    v-model="form.civil_status"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-lg"
                >
                    <option value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                </select>
            </div>


            <!-- Address Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="address" value="Address" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Address Here..."
                />
            </div>

            <!-- Contact No Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="contact_no" value="Contact No" />
                <TextInput
                    id="contact_no"
                    v-model="form.contact_no"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Contact No Here..."
                />
                <InputError class="mt-2" :message="form.errors.contact_no" />
            </div>

            <!-- Emergency Name Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="emergency_name" value="Emergency Name" />
                <TextInput
                    id="emergency_name"
                    v-model="form.emergency_name"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Emergency Name Here..."
                />
            </div>

            <!-- Emergency Relationship Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="emergency_relationship" value="Emergency Relationship" />
                <TextInput
                    id="emergency_relationship"
                    v-model="form.emergency_relationship"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Emergency Relationship Here..."
                />
            </div>

            <!-- Emergency Address Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="emergency_address" value="Emergency Address" />
                <TextInput
                    id="emergency_address"
                    v-model="form.emergency_address"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Emergency Address Here..."
                />
            </div>

            <!-- Emergency Contact No Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="emergency_contact_no" value="Emergency Contact No" />
                <TextInput
                    id="emergency_contact_no"
                    v-model="form.emergency_contact_no"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Emergency Contact No Here..."
                />
            </div>

            <!-- Password Input -->
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    required
                    type="password"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Password Here..."
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm Password Here..."
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const form = useForm({
    name: '',
    mname: '',
    lname: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'Patient', 
    course_year: '',
    date_of_birth: '',
    age: '',
    gender: '',
    position: '',
    civil_status: '',
    address: '',
    contact_no: '',
    emergency_name: '',
    emergency_relationship: '',
    emergency_address: '',
    emergency_contact_no: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>