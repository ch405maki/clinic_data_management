<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
                <p class="text-right">Home / <span class="text-green-600">Dashboard</span></p>
            </div>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto">
                <div v-if="currentUserRole === 'Admin'">
                    <div class="bg-white py-8 rounded-lg shadow grid grid-cols-1 gap-4 px-4 mt-2 sm:grid-cols-4 sm:px-8">
                    <!-- Card 1: Total Patients -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-green-400 flex items-center justify-center">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Total Patients</h3>
                            <p class="text-3xl">{{ patientCount }}</p>
                        </div>
                    </div>

                    <!-- Card 2: Total Doctors -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-blue-400 flex items-center justify-center">
                            <i class="fas fa-user-md fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Total Doctors</h3>
                            <p class="text-3xl">{{ doctorCount }}</p>
                        </div>
                    </div>

                    <!-- Card 3: Total Staffs -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-indigo-400 flex items-center justify-center">
                            <i class="fas fa-user-friends fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Total Staffs</h3>
                            <p class="text-3xl">{{ nurseCount }}</p>
                        </div>
                    </div>

                    <!-- Card 4: Prescriptions -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-red-400 flex items-center justify-center">
                            <i class="fas fa-file-prescription fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Diagnose</h3>
                            <p class="text-3xl">{{ individualRecordCount }}</p>
                        </div>
                    </div>
                </div>
                </div>
                
                <div v-if="currentUserRole != 'Admin'">
                    <div class="bg-white py-8 rounded-lg shadow grid grid-cols-1 gap-4 px-4 mt-2 sm:grid-cols-3 sm:px-8">
                    <!-- Card 1: Total Patients -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-green-400 flex items-center justify-center">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Total Patients</h3>
                            <p class="text-3xl">{{ patientCount }}</p>
                        </div>
                    </div>

                    <!-- Card 3: Total Staffs -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-indigo-400 flex items-center justify-center">
                            <i class="fas fa-user-friends fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Total Staffs</h3>
                            <p class="text-3xl">{{ nurseCount }}</p>
                        </div>
                    </div>

                    <!-- Card 4: Prescriptions -->
                    <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                        <div class="p-5 bg-red-400 flex items-center justify-center">
                            <i class="fas fa-file-prescription fa-2x text-white"></i>
                        </div>
                        <div class="px-4 text-gray-700">
                            <h3 class="text-sm tracking-wider">Diagnose</h3>
                            <p class="text-3xl">{{ individualRecordCount }}</p>
                        </div>
                    </div>
                </div>
                </div>

                <div v-if="currentUserRole != 'Admin'" class="flex flex-col mt-4 shadow rounded-lg">
                    <!-- Title -->
                    <div class="bg-gray-100 px-6 py-4 rounded-t-lg">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Patient</h2>
                    </div>
                    <div class="overflow-x-auto rounded-b-lg">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full rounded-lg">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Patient ID </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Patient Name </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Contact #</th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Email </th>
                                            <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize"> Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300">
                                        <tr v-for="patient in recentPatients" :key="patient.id" class="bg-white transition-all duration-500 hover:bg-gray-50">
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ patient.id }} </td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ patient.name }} </td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ patient.contact_no }} </td>
                                            <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> {{ patient.email }} </td>
                                            <td class=" p-5 ">
                                                <!-- Actions -->
                                                <div class="flex items-center gap-1">
                                                    <div v-if="currentUserRole != 'Doctor'">
                                                        <button @click="getVital(patient.id)" class="p-2 text-indigo-500 ounded-full group transition-all duration-500 flex items-center">
                                                            <!-- Edit Button -->
                                                            <svg class="cursor-pointer" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path class="fill-indigo-500 " d="M9.53414 8.15675L8.96459 7.59496L8.96459 7.59496L9.53414 8.15675ZM13.8911 3.73968L13.3215 3.17789V3.17789L13.8911 3.73968ZM16.3154 3.75892L15.7367 4.31126L15.7367 4.31127L16.3154 3.75892ZM16.38 3.82658L16.9587 3.27423L16.9587 3.27423L16.38 3.82658ZM16.3401 6.13595L15.7803 5.56438L16.3401 6.13595ZM11.9186 10.4658L12.4784 11.0374L11.9186 10.4658ZM11.1223 10.9017L10.9404 10.1226V10.1226L11.1223 10.9017ZM9.07259 10.9951L8.52556 11.5788L8.52556 11.5788L9.07259 10.9951ZM9.09713 8.9664L9.87963 9.1328V9.1328L9.09713 8.9664ZM9.05721 10.9803L8.49542 11.5498H8.49542L9.05721 10.9803ZM17.1679 4.99458L16.368 4.98075V4.98075L17.1679 4.99458ZM15.1107 2.8693L15.1171 2.06932L15.1107 2.8693ZM9.22851 8.51246L8.52589 8.12992L8.52452 8.13247L9.22851 8.51246ZM9.22567 8.51772L8.52168 8.13773L8.5203 8.1403L9.22567 8.51772ZM11.5684 10.7654L11.9531 11.4668L11.9536 11.4666L11.5684 10.7654ZM11.5669 10.7662L11.9507 11.4681L11.9516 11.4676L11.5669 10.7662ZM11.3235 3.30005C11.7654 3.30005 12.1235 2.94188 12.1235 2.50005C12.1235 2.05822 11.7654 1.70005 11.3235 1.70005V3.30005ZM18.3 9.55887C18.3 9.11705 17.9418 8.75887 17.5 8.75887C17.0582 8.75887 16.7 9.11705 16.7 9.55887H18.3ZM3.47631 16.5237L4.042 15.9581H4.042L3.47631 16.5237ZM16.5237 16.5237L15.958 15.9581L15.958 15.9581L16.5237 16.5237ZM10.1037 8.71855L14.4606 4.30148L13.3215 3.17789L8.96459 7.59496L10.1037 8.71855ZM15.7367 4.31127L15.8013 4.37893L16.9587 3.27423L16.8941 3.20657L15.7367 4.31127ZM15.7803 5.56438L11.3589 9.89426L12.4784 11.0374L16.8998 6.70753L15.7803 5.56438ZM10.9404 10.1226C10.3417 10.2624 9.97854 10.3452 9.72166 10.3675C9.47476 10.3888 9.53559 10.3326 9.61962 10.4113L8.52556 11.5788C8.9387 11.966 9.45086 11.9969 9.85978 11.9615C10.2587 11.9269 10.7558 11.8088 11.3042 11.6807L10.9404 10.1226ZM8.31462 8.8C8.19986 9.33969 8.09269 9.83345 8.0681 10.2293C8.04264 10.6393 8.08994 11.1499 8.49542 11.5498L9.619 10.4107C9.70348 10.494 9.65043 10.5635 9.66503 10.3285C9.6805 10.0795 9.75378 9.72461 9.87963 9.1328L8.31462 8.8ZM9.61962 10.4113C9.61941 10.4111 9.6192 10.4109 9.619 10.4107L8.49542 11.5498C8.50534 11.5596 8.51539 11.5693 8.52556 11.5788L9.61962 10.4113ZM15.8013 4.37892C16.0813 4.67236 16.2351 4.83583 16.3279 4.96331C16.4073 5.07234 16.3667 5.05597 16.368 4.98075L17.9678 5.00841C17.9749 4.59682 17.805 4.27366 17.6213 4.02139C17.451 3.78756 17.2078 3.53522 16.9587 3.27423L15.8013 4.37892ZM16.8998 6.70753C17.1578 6.45486 17.4095 6.21077 17.5876 5.98281C17.7798 5.73698 17.9607 5.41987 17.9678 5.00841L16.368 4.98075C16.3693 4.90565 16.4103 4.8909 16.327 4.99749C16.2297 5.12196 16.0703 5.28038 15.7803 5.56438L16.8998 6.70753ZM14.4606 4.30148C14.7639 3.99402 14.9352 3.82285 15.0703 3.71873C15.1866 3.62905 15.1757 3.66984 15.1044 3.66927L15.1171 2.06932C14.6874 2.06591 14.3538 2.25081 14.0935 2.45151C13.8518 2.63775 13.5925 2.9032 13.3215 3.17789L14.4606 4.30148ZM16.8941 3.20657C16.6279 2.92765 16.373 2.65804 16.1345 2.46792C15.8774 2.26298 15.5468 2.07273 15.1171 2.06932L15.1044 3.66927C15.033 3.66871 15.0226 3.62768 15.1372 3.71904C15.2704 3.82522 15.4387 3.999 15.7367 4.31126L16.8941 3.20657ZM8.96459 7.59496C8.82923 7.73218 8.64795 7.90575 8.5259 8.12993L9.93113 8.895C9.92075 8.91406 9.91465 8.91711 9.93926 8.88927C9.97002 8.85445 10.0145 8.80893 10.1037 8.71854L8.96459 7.59496ZM9.87963 9.1328C9.9059 9.00925 9.91925 8.94785 9.93124 8.90366C9.94073 8.86868 9.94137 8.87585 9.93104 8.89515L8.5203 8.1403C8.39951 8.36605 8.35444 8.61274 8.31462 8.8L9.87963 9.1328ZM8.52452 8.13247L8.52168 8.13773L9.92967 8.89772L9.9325 8.89246L8.52452 8.13247ZM11.3589 9.89426C11.27 9.98132 11.2252 10.0248 11.1909 10.055C11.1635 10.0791 11.1658 10.0738 11.1832 10.0642L11.9536 11.4666C12.1727 11.3462 12.3427 11.1703 12.4784 11.0374L11.3589 9.89426ZM11.3042 11.6807C11.4912 11.6371 11.7319 11.5878 11.9507 11.4681L11.1831 10.0643C11.2007 10.0547 11.206 10.0557 11.1697 10.0663C11.1248 10.0793 11.0628 10.0941 10.9404 10.1226L11.3042 11.6807ZM11.1837 10.064L11.1822 10.0648L11.9516 11.4676L11.9531 11.4668L11.1837 10.064ZM16.399 6.10097L13.8984 3.60094L12.7672 4.73243L15.2677 7.23246L16.399 6.10097ZM10.8333 16.7001H9.16667V18.3001H10.8333V16.7001ZM3.3 10.8334V9.16672H1.7V10.8334H3.3ZM9.16667 3.30005H11.3235V1.70005H9.16667V3.30005ZM16.7 9.55887V10.8334H18.3V9.55887H16.7ZM9.16667 16.7001C7.5727 16.7001 6.45771 16.6984 5.61569 16.5851C4.79669 16.475 4.35674 16.2728 4.042 15.9581L2.91063 17.0894C3.5722 17.751 4.40607 18.0369 5.4025 18.1709C6.37591 18.3018 7.61793 18.3001 9.16667 18.3001V16.7001ZM1.7 10.8334C1.7 12.3821 1.6983 13.6241 1.82917 14.5976C1.96314 15.594 2.24905 16.4279 2.91063 17.0894L4.042 15.9581C3.72726 15.6433 3.52502 15.2034 3.41491 14.3844C3.3017 13.5423 3.3 12.4273 3.3 10.8334H1.7ZM10.8333 18.3001C12.3821 18.3001 13.6241 18.3018 14.5975 18.1709C15.5939 18.0369 16.4278 17.751 17.0894 17.0894L15.958 15.9581C15.6433 16.2728 15.2033 16.475 14.3843 16.5851C13.5423 16.6984 12.4273 16.7001 10.8333 16.7001V18.3001ZM16.7 10.8334C16.7 12.4274 16.6983 13.5423 16.5851 14.3844C16.475 15.2034 16.2727 15.6433 15.958 15.9581L17.0894 17.0894C17.7509 16.4279 18.0369 15.594 18.1708 14.5976C18.3017 13.6241 18.3 12.3821 18.3 10.8334H16.7ZM3.3 9.16672C3.3 7.57275 3.3017 6.45776 3.41491 5.61574C3.52502 4.79674 3.72726 4.35679 4.042 4.04205L2.91063 2.91068C2.24905 3.57225 1.96314 4.40612 1.82917 5.40255C1.6983 6.37596 1.7 7.61798 1.7 9.16672H3.3ZM9.16667 1.70005C7.61793 1.70005 6.37591 1.69835 5.4025 1.82922C4.40607 1.96319 3.5722 2.24911 2.91063 2.91068L4.042 4.04205C4.35674 3.72731 4.79669 3.52507 5.61569 3.41496C6.45771 3.30175 7.5727 3.30005 9.16667 3.30005V1.70005Z" fill="#818CF8"></path>
                                                            </svg>
                                                            Get Vitals
                                                        </button>
                                                    </div>
                                                    <div v-else>
                                                        <button @click="showUser(patient.id)" class="p-2  rounded-full  group transition-all duration-500  flex item-center" title="Diagnose Patient">
                                                            <svg class="cursor-pointer" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path class="fill-indigo-500 " d="M9.53414 8.15675L8.96459 7.59496L8.96459 7.59496L9.53414 8.15675ZM13.8911 3.73968L13.3215 3.17789V3.17789L13.8911 3.73968ZM16.3154 3.75892L15.7367 4.31126L15.7367 4.31127L16.3154 3.75892ZM16.38 3.82658L16.9587 3.27423L16.9587 3.27423L16.38 3.82658ZM16.3401 6.13595L15.7803 5.56438L16.3401 6.13595ZM11.9186 10.4658L12.4784 11.0374L11.9186 10.4658ZM11.1223 10.9017L10.9404 10.1226V10.1226L11.1223 10.9017ZM9.07259 10.9951L8.52556 11.5788L8.52556 11.5788L9.07259 10.9951ZM9.09713 8.9664L9.87963 9.1328V9.1328L9.09713 8.9664ZM9.05721 10.9803L8.49542 11.5498H8.49542L9.05721 10.9803ZM17.1679 4.99458L16.368 4.98075V4.98075L17.1679 4.99458ZM15.1107 2.8693L15.1171 2.06932L15.1107 2.8693ZM9.22851 8.51246L8.52589 8.12992L8.52452 8.13247L9.22851 8.51246ZM9.22567 8.51772L8.52168 8.13773L8.5203 8.1403L9.22567 8.51772ZM11.5684 10.7654L11.9531 11.4668L11.9536 11.4666L11.5684 10.7654ZM11.5669 10.7662L11.9507 11.4681L11.9516 11.4676L11.5669 10.7662ZM11.3235 3.30005C11.7654 3.30005 12.1235 2.94188 12.1235 2.50005C12.1235 2.05822 11.7654 1.70005 11.3235 1.70005V3.30005ZM18.3 9.55887C18.3 9.11705 17.9418 8.75887 17.5 8.75887C17.0582 8.75887 16.7 9.11705 16.7 9.55887H18.3ZM3.47631 16.5237L4.042 15.9581H4.042L3.47631 16.5237ZM16.5237 16.5237L15.958 15.9581L15.958 15.9581L16.5237 16.5237ZM10.1037 8.71855L14.4606 4.30148L13.3215 3.17789L8.96459 7.59496L10.1037 8.71855ZM15.7367 4.31127L15.8013 4.37893L16.9587 3.27423L16.8941 3.20657L15.7367 4.31127ZM15.7803 5.56438L11.3589 9.89426L12.4784 11.0374L16.8998 6.70753L15.7803 5.56438ZM10.9404 10.1226C10.3417 10.2624 9.97854 10.3452 9.72166 10.3675C9.47476 10.3888 9.53559 10.3326 9.61962 10.4113L8.52556 11.5788C8.9387 11.966 9.45086 11.9969 9.85978 11.9615C10.2587 11.9269 10.7558 11.8088 11.3042 11.6807L10.9404 10.1226ZM8.31462 8.8C8.19986 9.33969 8.09269 9.83345 8.0681 10.2293C8.04264 10.6393 8.08994 11.1499 8.49542 11.5498L9.619 10.4107C9.70348 10.494 9.65043 10.5635 9.66503 10.3285C9.6805 10.0795 9.75378 9.72461 9.87963 9.1328L8.31462 8.8ZM9.61962 10.4113C9.61941 10.4111 9.6192 10.4109 9.619 10.4107L8.49542 11.5498C8.50534 11.5596 8.51539 11.5693 8.52556 11.5788L9.61962 10.4113ZM15.8013 4.37892C16.0813 4.67236 16.2351 4.83583 16.3279 4.96331C16.4073 5.07234 16.3667 5.05597 16.368 4.98075L17.9678 5.00841C17.9749 4.59682 17.805 4.27366 17.6213 4.02139C17.451 3.78756 17.2078 3.53522 16.9587 3.27423L15.8013 4.37892ZM16.8998 6.70753C17.1578 6.45486 17.4095 6.21077 17.5876 5.98281C17.7798 5.73698 17.9607 5.41987 17.9678 5.00841L16.368 4.98075C16.3693 4.90565 16.4103 4.8909 16.327 4.99749C16.2297 5.12196 16.0703 5.28038 15.7803 5.56438L16.8998 6.70753ZM14.4606 4.30148C14.7639 3.99402 14.9352 3.82285 15.0703 3.71873C15.1866 3.62905 15.1757 3.66984 15.1044 3.66927L15.1171 2.06932C14.6874 2.06591 14.3538 2.25081 14.0935 2.45151C13.8518 2.63775 13.5925 2.9032 13.3215 3.17789L14.4606 4.30148ZM16.8941 3.20657C16.6279 2.92765 16.373 2.65804 16.1345 2.46792C15.8774 2.26298 15.5468 2.07273 15.1171 2.06932L15.1044 3.66927C15.033 3.66871 15.0226 3.62768 15.1372 3.71904C15.2704 3.82522 15.4387 3.999 15.7367 4.31126L16.8941 3.20657ZM8.96459 7.59496C8.82923 7.73218 8.64795 7.90575 8.5259 8.12993L9.93113 8.895C9.92075 8.91406 9.91465 8.91711 9.93926 8.88927C9.97002 8.85445 10.0145 8.80893 10.1037 8.71854L8.96459 7.59496ZM9.87963 9.1328C9.9059 9.00925 9.91925 8.94785 9.93124 8.90366C9.94073 8.86868 9.94137 8.87585 9.93104 8.89515L8.5203 8.1403C8.39951 8.36605 8.35444 8.61274 8.31462 8.8L9.87963 9.1328ZM8.52452 8.13247L8.52168 8.13773L9.92967 8.89772L9.9325 8.89246L8.52452 8.13247ZM11.3589 9.89426C11.27 9.98132 11.2252 10.0248 11.1909 10.055C11.1635 10.0791 11.1658 10.0738 11.1832 10.0642L11.9536 11.4666C12.1727 11.3462 12.3427 11.1703 12.4784 11.0374L11.3589 9.89426ZM11.3042 11.6807C11.4912 11.6371 11.7319 11.5878 11.9507 11.4681L11.1831 10.0643C11.2007 10.0547 11.206 10.0557 11.1697 10.0663C11.1248 10.0793 11.0628 10.0941 10.9404 10.1226L11.3042 11.6807ZM11.1837 10.064L11.1822 10.0648L11.9516 11.4676L11.9531 11.4668L11.1837 10.064ZM16.399 6.10097L13.8984 3.60094L12.7672 4.73243L15.2677 7.23246L16.399 6.10097ZM10.8333 16.7001H9.16667V18.3001H10.8333V16.7001ZM3.3 10.8334V9.16672H1.7V10.8334H3.3ZM9.16667 3.30005H11.3235V1.70005H9.16667V3.30005ZM16.7 9.55887V10.8334H18.3V9.55887H16.7ZM9.16667 16.7001C7.5727 16.7001 6.45771 16.6984 5.61569 16.5851C4.79669 16.475 4.35674 16.2728 4.042 15.9581L2.91063 17.0894C3.5722 17.751 4.40607 18.0369 5.4025 18.1709C6.37591 18.3018 7.61793 18.3001 9.16667 18.3001V16.7001ZM1.7 10.8334C1.7 12.3821 1.6983 13.6241 1.82917 14.5976C1.96314 15.594 2.24905 16.4279 2.91063 17.0894L4.042 15.9581C3.72726 15.6433 3.52502 15.2034 3.41491 14.3844C3.3017 13.5423 3.3 12.4273 3.3 10.8334H1.7ZM10.8333 18.3001C12.3821 18.3001 13.6241 18.3018 14.5975 18.1709C15.5939 18.0369 16.4278 17.751 17.0894 17.0894L15.958 15.9581C15.6433 16.2728 15.2033 16.475 14.3843 16.5851C13.5423 16.6984 12.4273 16.7001 10.8333 16.7001V18.3001ZM16.7 10.8334C16.7 12.4274 16.6983 13.5423 16.5851 14.3844C16.475 15.2034 16.2727 15.6433 15.958 15.9581L17.0894 17.0894C17.7509 16.4279 18.0369 15.594 18.1708 14.5976C18.3017 13.6241 18.3 12.3821 18.3 10.8334H16.7ZM3.3 9.16672C3.3 7.57275 3.3017 6.45776 3.41491 5.61574C3.52502 4.79674 3.72726 4.35679 4.042 4.04205L2.91063 2.91068C2.24905 3.57225 1.96314 4.40612 1.82917 5.40255C1.6983 6.37596 1.7 7.61798 1.7 9.16672H3.3ZM9.16667 1.70005C7.61793 1.70005 6.37591 1.69835 5.4025 1.82922C4.40607 1.96319 3.5722 2.24911 2.91063 2.91068L4.042 4.04205C4.35674 3.72731 4.79669 3.52507 5.61569 3.41496C6.45771 3.30175 7.5727 3.30005 9.16667 3.30005V1.70005Z" fill="#818CF8"></path>
                                                            </svg>
                                                            <span class="text-indigo-500">Diagnose</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div v-if="currentUserRole === 'Admin'" class="flex flex-col mt-4 shadow rounded-lg">
                    <!-- Title -->
                    <div class="bg-gray-100 px-6 py-4 rounded-t-lg">
                        <h2 class="text-lg font-semibold text-gray-900">User Request</h2>
                    </div>
                    <div class="overflow-x-auto rounded-b-lg">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
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
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';
import Swal from "sweetalert2";

const props = defineProps({
    doctorCount: { type: Number, required: true },
    patientCount: { type: Number, required: true },
    nurseCount: { type: Number, required: true },
    individualRecordCount: { type: Number, required: true },
    recentPatients: { type: Array, required: true },
    users: { type: Array, required: true },
    currentUserRole: { type: String, required: true },
});

const showUser = (id) => {
  Swal.fire({
    title: "View User Details?",
    text: "You will be redirected to the diagnosis page.",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Yes, view details!",
    cancelButtonText: "No, cancel!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `/diagnose/${id}`;
    }
  });
};

const getVital = (id) => {
  Swal.fire({
    title: "View User Details?",
    text: "You will be redirected to the diagnosis page.",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Yes, view details!",
    cancelButtonText: "No, cancel!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `/vitals/${id}`;
    }
  });
};


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