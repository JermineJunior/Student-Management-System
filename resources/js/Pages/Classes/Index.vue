<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import CreateClass from './Partials/CreateClass.vue';
import ClassRoom from './Partials/ClassRoom.vue';
import { ref }  from 'vue';

defineProps({
  classes: {
    type: Object,
    required: true
  },
  students: {
    type: Number,
  }
});

</script>

<template>

    <Head title="Classes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Class Rooms
            </h2>
        </template>
        <div class="py-10 bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Classes
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Classes.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <CreateClass />
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
                                                    Subjects
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                                    No of Students
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                                    Attendane
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                                    Created At
                                                </th>
                                                <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <div v-if="classes.data.length == 0"
                                            class="p-2 m-4 rounded-lg bg-yellow-500/10">
                                            <p class="italic font-bold text-gray-800">
                                                NO Results Found!
                                            </p>
                                        </div>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <ClassRoom v-for="(classRoom, index) in classes.data" :key="classRoom.id"
                                                :index="index" :classRoom="classRoom" />
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
