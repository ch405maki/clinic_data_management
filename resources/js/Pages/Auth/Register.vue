
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

            <!-- Position -->
            <div class="mt-4 mb-4">
                <InputLabel for="selector" value="Position" />
                <select
                    id="selector"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-royal-purple-500 focus:border-royal-purple-500 sm:text-sm"
                    v-model="form.selector"
                >
                    <option value="">Select a position</option>
                    <option value="Student">Student</option>
                    <option value="Employee">Employee</option>
                </select>
                <InputError class="mt-2" :message="form.errors.selector" />
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
            <div v-if="form.selector === 'Student'" class="sm:col-span-12 mt-4">
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
                @input="calculateAge"
                required
                type="date"
                class="mt-1 block w-full border border-gray-300 rounded-lg "
                placeholder="Date of Birth Here..."
                />
                <InputError class="mt-2" :message="form.errors.date_of_birth" />
            </div>

            <!-- Age Input -->
            <div class="sm:col-span-12 mt-4 hidden">
                <InputLabel for="age" value="Age" />
                <TextInput
                id="age"
                v-model="form.age"
                required    
                type="number"
                class="mt-1 block w-full border border-gray-300 rounded-lg "
                placeholder="Age Here..."
                readonly
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
            <div v-if="form.selector === 'Employee'" class="sm:col-span-12 mt-4">
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

            <!-- Profile Picture -->
            <div class="mt-4">
                <InputLabel for="profile_picture" value="Profile Picture" />
                <input 
                    id="profile_picture" 
                    type="file" 
                    class="mt-1 block w-full" 
                    @change="handleFileChange"
                />
                <InputError class="mt-2" :message="form.errors.profile_picture" />
                <img v-if="previewImage" :src="previewImage" class="w-20 h-20 object-cover">
            </div>

            <!-- Emergency Input -->
            <div class="sm:col-span-12 mt-4">
                <h1>Emergency Contact Details</h1>
                <InputLabel for="emergency_name" value="Emergency Name" />
                <TextInput
                    id="emergency_name"
                    v-model="form.emergency_name"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Emergency Name Here..."
                />
                <InputError class="mt-2" :message="form.errors.emergency_name" />
            </div>
            <div class="sm:col-span-12 mt-4">
                <InputLabel for="emergency_contact_no" value="Emergency Contact Number" />
                <TextInput
                    id="emergency_contact_no"
                    v-model="form.emergency_contact_no"
                    required
                    type="text"
                    class="mt-1 block w-full border border-gray-300 rounded-lg "
                    placeholder="Contact No Here..."
                />
                <InputError class="mt-2" :message="form.errors.emergency_contact_no" />
            </div>
            

            <!-- Password -->
            <div class="mt-4">
                    <label for="password" class="text-gray-600 mb-2 block">Password</label>
                    <p class="text-sm text-red-600 mb-2">
                        Password must be at least 8 characters long and include a mix of uppercase, lowercase, numbers, and special characters.
                    </p>
                    <div class="relative">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            id="password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                            placeholder="***********"
                            v-model="form.password"
                            @input="validatePassword"
                            required
                        />
                        <div
                            class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-8 text-gray-600 border-l border-gray-300"
                            @click="togglePasswordVisibility"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                                v-if="showPassword"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                                v-else
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <ul class="text-sm text-red-600 mt-2">
                        <li v-if="!passwordValid.length">- Minimum 8 characters.</li>
                        <li v-if="!passwordValid.uppercase">- At least one uppercase letter.</li>
                        <li v-if="!passwordValid.lowercase">- At least one lowercase letter.</li>
                        <li v-if="!passwordValid.number">- At least one number.</li>
                        <li v-if="!passwordValid.special">- At least one special character.</li>
                    </ul>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="text-gray-600 mb-2 block">Confirm Password</label>
                    <div class="relative">
                        <input
                            :type="showConfirmPassword ? 'text' : 'password'"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-teal-500 placeholder-gray-400"
                            placeholder="***********"
                            v-model="form.password_confirmation"
                            @input="validatePasswordMatch"
                            required
                        />
                        <div
                            class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-8 text-gray-600 border-l border-gray-300"
                            @click="toggleConfirmPasswordVisibility"
                        >
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                                v-if="showPassword"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5"
                                v-else
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p v-if="!passwordMatch" class="text-sm text-red-600 mt-2">Passwords do not match.</p>
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
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const showPassword = ref(false);
    const showConfirmPassword = ref(false);

    function togglePasswordVisibility() {
        showPassword.value = !showPassword.value;
    }

    function toggleConfirmPasswordVisibility() {
        showConfirmPassword.value = !showConfirmPassword.value;
    }

    const passwordValid = ref({
        length: false,
        uppercase: false,
        lowercase: false,
        number: false,
        special: false,
    });

    const passwordMatch = ref(true);

    function validatePassword() {
        const password = form.password;
        passwordValid.value.length = password.length >= 8;
        passwordValid.value.uppercase = /[A-Z]/.test(password);
        passwordValid.value.lowercase = /[a-z]/.test(password);
        passwordValid.value.number = /[0-9]/.test(password);
        passwordValid.value.special = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    }

    function validatePasswordMatch() {
        passwordMatch.value = form.password === form.password_confirmation;
    }

    function calculateAge() {
    if (form.date_of_birth) {
        const dob = new Date(form.date_of_birth);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
        form.age = age - 1;
        } else {
        form.age = age;
        }
    } else {
        form.age = '';
    }
    }

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
        profile_picture: null, 
        selector: '',
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    };

    const previewImage = ref(null);

    const handleFileChange = (e) => {
    form.profile_picture = e.target.files[0];
    previewImage.value = URL.createObjectURL(e.target.files[0]);
    };
</script>