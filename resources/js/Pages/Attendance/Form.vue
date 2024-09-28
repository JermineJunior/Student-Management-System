<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { reactive, ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'

const props = defineProps({
    classroom: {
        type: Object,
        required: true
    },
    students: {
        type: Object,
    }
});

const date = new Date();

let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

// This arrangement can be altered based on how we want the date's format to appear.
let currentDate = `${day}-${month}-${year}`;

// State to hold attendance data
const attendance = reactive({});
const processing = ref(false);
const successMessage = ref(null);

// Ref to hold success message
const message = ref('');

// Initialize attendance with default value (1 for present)
onMounted(() => {
  props.students.forEach(student => {
    attendance[student.id] = 1; // Default to present
  });
});
// Function to handle form submission
const submitAttendance = () => {
  const formData = Object.keys(attendance).map(studentId => ({
    student_id: studentId,
    status: attendance[studentId] // 1 for present (checked), 0 for absent (unchecked)
  }));

  router.post(`/students/${props.classroom.id}/attendance`, { attendance: formData }, {
    onSuccess: () => {
      successMessage.value = 'Attendance successfully recorded!';
    },
    onError: (error) => {
      console.error(error);
    }
  });
};

</script>

<template>

    <Head title="Attandence" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Class Room Attendance
                </h2>
                <div class="text-sm text-gray-700">
                    <span>Data: {{ currentDate }}</span>
                </div>
            </div>
        </template>
        <div class="py-10 bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                {{ props.classroom.name }} Attendance
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the students in {{ props.classroom.name }}.
                            </p>
                        </div>
                        <div class="mt-4 text-sm sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link
                                class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-md border border-transparent hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                :href="route('classes.index')">
                            go back
                            </Link>
                        </div>
                    </div>

                    <!-- displaying classes info -->
                <div class="flex flex-col mt-8">
                    <div class="overflow-x-auto -mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full align-middle md:px-6 lg:px-8" v-if="props.students.length > 0">
                            <form @submit.prevent="submitAttendance">
                                <div
                                    class="overflow-hidden relative ring-1 ring-black ring-opacity-5 shadow md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    NO
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    Class Room
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    Date
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    Attendance
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(student, index) in props.students" :key="student.id"
                                                class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
                                                <td
                                                    class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    {{ index + 1 }}
                                                </td>
                                                <td
                                                    class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    {{ student.name }}
                                                </td>
                                                <td
                                                    class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    {{ props.classroom.name }}
                                                </td>
                                                <td
                                                    class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    {{ currentDate }}
                                                </td>

                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    <div class="flex items-center space">
                                                     <input
                                                        type="checkbox"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded "
                                                        :name="'attendance_' + student.id"
                                                        v-model="attendance[student.id]"
                                                        :true-value="1"
                                                        :false-value="0"
                                                        :checked=true
                                                      />
                                                      <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Present</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex justify-end p-4 w-full">
                                        <div class="flex justify-end w-full">
                                            <button
                                                type="submit"
                                                class="inline-flex items-center px-6 py-2 mr-4 text-sm font-bold text-white bg-indigo-600 rounded-md border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                :disabled="processing"
                                                >Submit Attendance</button>
                                        </div>
                                    </div>

                                </div>
                                </form>
                            </div>
                            <div v-else class="p-4 mb-4 text-sm text-red-600 rounded-lg " role="alert">
                                <p class="font-medium mx-4" > The selected classroom dosent has any students !!! </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
