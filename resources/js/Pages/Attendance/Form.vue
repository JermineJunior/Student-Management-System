<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

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
</script>

<template>

    <Head title="Attandence" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Class Room Attendance
            </h2>
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

                    </div>

                    <!-- displaying classes info -->
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto -mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 min-w-full align-middle md:px-6 lg:px-8">
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
                                                    <div class="flex items-center">
                                                        <input checked id="checked-checkbox" type="checkbox" value=""
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="checked-checkbox"
                                                            class="text-sm font-medium text-gray-900 ms-2 dark:text-gray-300">Present</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex justify-end p-4 w-full">
                                        <div class="flex justify-end w-full">
                                            <button>Save</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
