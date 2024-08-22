<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3'
import CreateClass from './Partials/CreateClass.vue';

defineProps({
  classes: {
    type: Object,
    required: true
  },
  students: {
    type: Number,
  }
});

const deleteForm = useForm({});

const deleteClass = (id) => {
  if (confirm("Are you sure you want to delete this class?")) {
    deleteForm.delete(route("classes.destroy", id), {
      preserveScroll: true,
    });
  }
};

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
              <p class="mt-2 text-sm text-gray-500">
                {{ students }} Students total .
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
                <div class="overflow-hidden relative ring-1 ring-black ring-opacity-5 shadow md:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          NO
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Name
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Subjects
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                          No of Students
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                          Created At
                        </th>
                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6" />
                      </tr>
                    </thead>
                    <div v-if="classes.data.length == 0" class="p-2 m-4 rounded-lg bg-yellow-500/10">
                      <p class="italic font-bold text-gray-800">
                        NO Results Found!
                      </p>
                    </div>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="(Class, index) in classes.data" :key="Class.id"
                        class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
                        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                          {{ index + 1 }}
                        </td>
                        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                          {{ Class.name }}
                        </td>
                        <td class="py-4 text-sm font-medium text-gray-900 whitespace-nowrap x-5 sm:pl-6">
                          <Link :href="route('subjects.index')" class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mx-[2px] size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                          </svg>
                          {{ Class.subjects.length }}
                          </Link>
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ Class.students }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ Class.addedOn }}
                        </td>
                        <td class="relative py-4 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                          <Link :href="route('classes.edit', Class.id)" class="text-indigo-600 hover:text-indigo-900">
                          Edit
                          </Link>
                          <button @click="
                            deleteClass(
                              Class.id,
                            )
                            " class="ml-2 text-indigo-600 hover:text-indigo-900">
                            Delete
                          </button>
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
