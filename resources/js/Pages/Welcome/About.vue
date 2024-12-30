<template>
  <Head title="About" />
  <Nav :navigation="navigation" />
  
  <div class="flex flex-col justify-center items-center">
    <!-- Organizational Chart -->
    <div class="flex flex-col items-center py-8">
    <h1 class="text-2xl font-bold mb-6">Barangay Organizational Chart</h1>

    <!-- Chart Container -->
    <div class="flex flex-col items-center w-full space-y-4">
      <!-- Central Node -->
      <div class="node bg-gray-500 text-white  rounded shadow">
        <div class="flex flex-col max-w-md">
          <div class="flex flex-col sm:flex-row border border-gray-700 py-1 px-1 w-full sm:text-left">
            <div class="flex-shrink-0  m-4 w-10 h-10 rounded-full bg-gray-400 self-center"></div>
            <div class="flex flex-col py-2 pr-2">
              <h4 class="text-lg font-light">Full Name</h4>
              <p class="text-sm font-hairline">Punong Barangay</p>
            </div>
          </div>
          </div>
      </div>

      <!-- Parent Level -->
      <div class="flex justify-center w-full space-x-8">
        <!-- Committee on Operations -->
        <div class="flex flex-col items-center">
          <!-- Main Node -->
          <div class="node flex items-center bg-gray-300 w-64 p-4 rounded shadow">
            <div class="flex-shrink-0 mr-4">
              <img src="/images/main-member.jpg" alt="Main Member" class="w-10 h-10 rounded-full bg-gray-400">
            </div>
            <div class="flex flex-col">
              <h4 class="text-lg font-light">Juan Dela Cruz</h4>
              <p class="text-sm font-hairline">Committee on Operations</p>
            </div>
          </div>

          <!-- Connecting Line -->
          <div class="line h-6 w-0.5 bg-gray-400"></div>

          <!-- Child Nodes -->
          <div class="child-nodes flex flex-col items-center space-y-2">
            <!-- Child Node 1 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <div class="flex-shrink-0 mr-4">
                <img src="/images/child1.jpg" alt="Child 1" class="w-10 h-10 rounded-full bg-gray-400">
              </div>
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Maria Santos</h4>
                <p class="text-xs">SB Member, Chair on Peace and Order</p>
              </div>
            </div>

            <!-- Child Node 2 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <div class="flex-shrink-0 mr-4">
                <img src="/images/child2.jpg" alt="Child 2" class="w-10 h-10 rounded-full bg-gray-400">
              </div>
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Pedro Reyes</h4>
                <p class="text-xs">SB Member, Co-Vice Chair on Peace and Order</p>
              </div>
            </div>

            <!-- Child Node 3 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <div class="flex-shrink-0 mr-4">
                <img src="/images/child3.jpg" alt="Child 3" class="w-10 h-10 rounded-full bg-gray-400">
              </div>
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Ana Cruz</h4>
                <p class="text-xs">Barangay Secretary</p>
              </div>
            </div>
          </div>
        </div>



        <!-- Central Nodes -->
        <div class="flex flex-col items-center">
          <!-- Main Node -->
          <div class="node bg-gray-300 w-64 p-4 rounded shadow flex items-center">
            <div class="flex-shrink-0 mr-4">
              <img src="/images/main-member.jpg" alt="Main Member" class="w-10 h-10 rounded-full bg-gray-400">
            </div>
            <div class="flex flex-col">
              <h4 class="text-lg font-light">Juan Dela Cruz</h4>
              <p class="text-sm font-hairline">SB / Vice Chair on Peace and Order</p>
            </div> 
          </div>
          
          <!-- Connecting Line -->
          <div class="line h-6 w-0.5 bg-gray-400"></div>

          <!-- Child Nodes -->
          <div class="child-nodes flex flex-col items-center space-y-2">
            <!-- Child Node 1 with Image -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child1.jpg" alt="SB Member" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Maria Santos</h4>
                <p class="text-xs">SB / Co-Vice Chair on Peace and Order</p>
              </div>
            </div>

            <!-- Child Node 2 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child2.jpg" alt="Kagawad" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Pedro Reyes</h4>
                <p class="text-xs">Kagawad</p>
              </div>
            </div>

            <!-- Child Node 3 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child3.jpg" alt="SK Chairman" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Ana Cruz</h4>
                <p class="text-xs">SK Chairman</p>
              </div>
            </div>

            <!-- Child Node 4 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child4.jpg" alt="Representative" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">John Villanueva</h4>
                <p class="text-xs">Representative</p>
              </div>
            </div>

            <!-- Child Node 5 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child5.jpg" alt="Chief Tanod" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Ronald Cruz</h4>
                <p class="text-xs">Chief Tanod</p>
              </div>
            </div>

            <!-- Child Node 6 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child6.jpg" alt="NGO Representative" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Lorna Ramirez</h4>
                <p class="text-xs">Representative, NGO/Civic Society</p>
              </div>
            </div>

            <!-- Child Node 7 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child7.jpg" alt="Religious Organization" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Father Miguel</h4>
                <p class="text-xs">Religious Faith Organization</p>
              </div>
            </div>

            <!-- Child Node 8 -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/child8.jpg" alt="City Chief" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Chief Bato</h4>
                <p class="text-xs">City Chief of Police</p>
              </div>
            </div>
          </div>
        </div>



        <!-- Committee on Advocacy -->
        <div class="flex flex-col items-center">
          <!-- Committee Node -->
          <div class="node bg-gray-300 w-64 p-4 rounded shadow flex items-center">
            <div class="flex-shrink-0 mr-4">
              <img src="/images/main-member.jpg" alt="Main Member" class="w-10 h-10 rounded-full bg-gray-400">
            </div>
            <div class="flex flex-col">
              <h4 class="text-lg font-light">Juan Dela Cruz</h4>
              <p class="text-sm font-hairline">SB / Vice Chair on Peace and Order</p>
            </div>
          </div>

          <!-- Connecting Line -->
          <div class="line h-6 w-0.5 bg-gray-400"></div>

          <!-- Child Nodes -->
          <div class="child-nodes flex flex-col items-center space-y-2">
            <!-- Kagawad -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/kagawad.jpg" alt="Kagawad" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Full Name</h4>
                <p class="text-xs">Kagawad</p>
              </div>
            </div>

            <!-- SK Chairman -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/sk_chairman.jpg" alt="SK Chairman" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Full Name</h4>
                <p class="text-xs">SK Chairman</p>
              </div>
            </div>

            <!-- NGO/Civic Society Representative -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/ngo_representative.jpg" alt="NGO Representative" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Full Name</h4>
                <p class="text-xs">Representative, NGO/Civic Society</p>
              </div>
            </div>

            <!-- Religious Faith Organization -->
            <div class="child bg-white w-64 p-4 flex items-center border rounded shadow">
              <img src="/images/religious_org.jpg" alt="Religious Organization" class="w-10 h-10 rounded-full mr-4">
              <div class="flex flex-col">
                <h4 class="text-sm font-semibold">Full Name</h4>
                <p class="text-xs">Religious Faith Organization</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
  
  <Footer />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Footer from './Partials/Footer.vue';
import Nav from './Partials/Nav.vue';


const props = defineProps({
  posts: {
    type: Array,
    required: true,
  },
  navigation: {
    type: Object,
    required: true,
  },
  canLogin: {
    type: Boolean,
    required: true,
  },
  canRegister: {
    type: Boolean,
    required: true,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});


</script>

<style scoped>
.node {
  display: flex;
  justify-content: center;
  align-items: center;
}
.line {
  margin: -0.5rem auto;
}
</style>
