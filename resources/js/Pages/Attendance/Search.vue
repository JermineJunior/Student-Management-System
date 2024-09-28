<template>
<Head title="Attandence" />
 <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Class Room Attendance
                </h2>
            </div>
        </template>
        <div class="py-6 bg-gray-100">
            <div class="mx-auto max-w-7xl">

            <!-- Attendance Search Form -->
            <form @submit.prevent="submitForm" class="flex justify-end">
              <div class="flex items-center space-x-2">
                <div>
                <select v-model="form.class_id" name="class_id" required class="block py-2 ml-2 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                  <option value="" disabled>Select a class</option>
                  <option v-for="classItem in classes.data" :key="classItem.id" :value="classItem.id">
                    {{ classItem.name }}
                  </option>
                </select>
              </div>
            <div>
             <input type="date" v-model="form.date" name="date" required class="block py-2 ml-2 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 sm:text-sm sm:leading-6" />
            </div>
              <button class="block items-center px-6 py-2 ml-2  mr-4 text-sm font-bold text-white bg-indigo-600 rounded-md border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit" :disabled="processing">Search</button>
          </div>
         </form>

        <!-- Attendance Display -->
        <div class="my-6" v-if="attendanceDate && props.students.data.length > 0">
          <h2 class="text-lg py-4 font-semibold text-gray-900" >Attendance for Class: {{ props.students.data[0].class.name }} on {{ attendanceDate }}</h2>
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col"
                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">#</th>
                <th scope="col"
                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">Student Name</th>
                <th scope="col"
                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">Date</th>
                <th scope="col"
                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">Status</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" >
              <tr v-for="(student , index) in props.students.data" :key="student.id">
                <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6" >{{ index + 1 }}</td>
                <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6" >{{ student.name }}</td>
                <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6" >{{ attendanceDate }}</td>
                <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6" >
                  <span v-if="attendances[student.id]" :class="attendances[student.id].status ? 'text-indigo-600' : 'text-red-600'">
                    {{ attendances[student.id].status ? 'Present &#x2713;' : 'Absent &#x2717;' }}
                  </span>
                  <span v-else class="text-gray-700">
                    Not Recorded
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else-if="attendanceDate">
          <p>No attendance records found for this class on {{ attendanceDate }}.</p>
        </div>
      </div>
    </div>
</AuthenticatedLayout>
</template>

<script setup>
import { reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';

// Props passed from the controller
const props = defineProps({
  classes: Object ,
  class: Object,
  students : Array,
  attendances: Object,
  attendanceDate: String,
  selectedClass: Number
});

// Initialize the form state
const form = useForm({
  class_id: props.selectedClass || '',
  date: props.attendanceDate || ''
});

// Function to handle form submission
const submitForm = () => {
  form.post('/attendance', {
     preserveScroll: true
  });
};
</script>

<style scoped>

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px 12px;
  border: 1px solid #ddd;
}

th {
  background-color: #f4f4f4;
}
</style>
