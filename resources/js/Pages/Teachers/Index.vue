<script setup>
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";

defineProps({
  teachers: {
    type: Object
  },
  search: {
    type: String,
  }
});
//capture the user`s search value
const search = ref(usePage().props.search),
  pageNumber = ref(1);
let teachersUrl = computed(() => {
  //build the current url
  let url = new URL(route('teachers.index'));
  /**
   * reseating the page number to view the
   *  returned search data
   */
  url.searchParams.append("page", pageNumber.value);
  //append the user search as a param to the url 
  if (search.value) {
    url.searchParams.append("search", search.value);
  }
  return url;
});
//keep track of the changes in the url 
watch(
  () => teachersUrl.value,
  //capture and visit the new url on change
  (updatedUrl) => {
    router.visit(updatedUrl, {
      preserveScroll: true,
      preserveState: true,
      replace: true
    })
  });
const clearFilters = () => {
  search.value = "";
};

const deleteForm = useForm({});

const deleteTeacher = (id) => {
  if (confirm("Are you sure you want to delete this teacher?")) {
    deleteForm.delete(route("teachers.destroy", id), {
      preserveScroll: true,
    });
  }
};
</script>
<template>

  <Head title="Teachers" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Teachers
      </h2>
    </template>
    <div class="py-10 bg-gray-100">
      <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900">
                Teachers
              </h1>
              <p class="mt-2 text-sm text-gray-700">
                A list of all the teachers.
              </p>
            </div>

            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
              <Link :href="route('teachers.create')"
                class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
              Add Teachers
              </Link>
            </div>
          </div>

          <div class="flex flex-col justify-start mt-6 sm:flex-row">
            <div class="relative col-span-3 text-sm text-gray-800">
              <div class="flex absolute top-0 bottom-0 left-0 items-center pl-2 text-gray-500 pointer-events-none">
                <MagnifyingGlass />
              </div>

              <input type="text" placeholder="Search teachers data..." id="search" v-model="search"
                class="block py-2 pl-10 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>

            <button @click="clearFilters" class="mx-3 text-sm text-gray-700">
              clear all
            </button>
          </div>

          <div class="flex flex-col mt-8">
            <div class="overflow-x-auto -mx-4 -my-2 sm:-mx-6 lg:-mx-8">
              <div class="inline-block py-2 min-w-full align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden relative ring-1 ring-black ring-opacity-5 shadow md:rounded-lg">
                  <!-- if search results return 0 -->
                  <div v-if="teachers.data.length == 0"
                    class="flex overflow-hidden mx-8 my-3 w-full max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="flex justify-center items-center w-12 bg-red-500">
                      <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
                      </svg>
                    </div>

                    <div class="px-4 py-2 -mx-3">
                      <div class="mx-3">
                        <span class="font-semibold text-red-500 dark:text-red-400">Error</span>
                        <p class="text-sm text-gray-100">
                          No Results found
                        </p>
                      </div>
                    </div>
                  </div>
                  <table class="divide-y divide-gray-300 lg:min-w-full md:max-w-xl" v-if="teachers.data.length !== 0">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          No
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Name
                        </th>
                        <th scope="col" class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                          Email
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                          Phone
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                          Recruited On
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                          Specialty
                        </th>
                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6" />
                      </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="(teacher, index) in teachers.data" :key="teacher.id"
                        class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
                        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                          {{ index + 1 }}
                        </td>
                        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                          {{ teacher.name }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ teacher.email }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ teacher.phone }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ teacher.date_of_recruit }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                          {{ teacher.specialty }}
                        </td>

                        <td class="relative py-4 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                          <Link :href="route(
                            'teachers.edit',
                            teacher.id,
                          )
                            " class="text-indigo-600 hover:text-indigo-900">
                          Edit
                          </Link>
                          <button @click="
                            deleteTeacher(
                              teacher.id,
                            )
                            " class="ml-2 text-red-500 hover:text-red-700">
                            Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- <Pagination v-if="teachers.data.length !== 0" :data="teachers" :pageNumberUpdated="pageNumberUpdated" /> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>