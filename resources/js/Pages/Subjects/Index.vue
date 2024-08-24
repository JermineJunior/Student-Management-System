<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Edit from './Partials/Edit.vue';

defineProps({
  subjects: {
    type: Object,
    required: true
  },
  classroom: {
    type: String,
  }
});

</script>

<template>

  <Head title="Subjects" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Subjects</h2>
    </template>

    <!-- display subjects -->
    <div class="py-10 bg-gray-100">
      <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">
                Subjects
              </h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of all the subjects for Class Room {{ classroom }}.
              </p>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
              <Link :href="route('subjects.create')"
                class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
              Add Subject
              </Link>
            </div>
          </div>
          <div class="flex flex-col mt-8">
            <div class="overflow-x-auto -mx-4 -my-2 sm:-mx-6 lg:-mx-8">
              <div class="inline-block py-2 min-w-full align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden relative ring-1 ring-black ring-opacity-5 shadow md:rounded-lg">

                  <table class="divide-y divide-gray-300 lg:min-w-full md:max-w-xl">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          No
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Name
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Full Marks
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Class
                        </th>
                        <th scope="col"
                          class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6" />
                      </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="(subject, index) in subjects.data" :key="subject.id"
                        class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
                        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                          {{ index + 1 }}
                        </td>
                        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                          {{ subject.name }}
                        </td>
                        <td class="py-3.5 pr-3 pl-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ subject.full_mark }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ subject.class.name }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          <Edit :subject />
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
    </div>
  </AuthenticatedLayout>
</template>
