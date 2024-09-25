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
            <form @submit.prevent="submitForm">
              <div class="flex items-center space-x-4">
                <div>
                <select v-model="form.class_id" name="class_id" required class="block py-2 ml-3 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                  <option value="" disabled>Select a class</option>
                  <option v-for="classItem in classes.data" :key="classItem.id" :value="classItem.id">
                    {{ classItem.name }}
                  </option>
                </select>
              </div>
            <div>
                <input type="date" v-model="form.date" name="date" required class="block py-2 ml-3 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 sm:text-sm sm:leading-6" />
        </div>


              <button class="block items-center px-6 py-2  mr-4 text-sm font-bold text-white bg-indigo-600 rounded-md border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit" :disabled="processing">Search</button>
            </div>
            </form>

            <!-- Attendance Display -->
            <div v-if="attendanceDate && props.class.students.length > 0">
              <h2>Attendance for Class: {{ props.class.name }} on {{ attendanceDate }}</h2>
              <table>
                <thead>
                  <tr>
                    <th>Student Name</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="student in props.class.students" :key="student.id">
                    <td>{{ student.name }}</td>
                    <td>
                      <span v-if="attendances[student.id]">
                        {{ attendances[student.id].status ? 'Present' : 'Absent' }}
                      </span>
                      <span v-else>
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
  attendances: Object,
  attendanceDate: String,
  selectedClass: Number
});

// Initialize the form state
const form = reactive({
  class_id: props.selectedClass || '',
  date: props.attendanceDate || ''
});

// Set up Inertia's form handler
const { post, processing } = useForm(form);

// Function to handle form submission
const submitForm = () => {
  router.post('/attendance', form);
};
</script>

<style scoped>
form {
  margin-bottom: 20px;
}

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
