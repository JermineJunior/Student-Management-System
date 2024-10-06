<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";

let checked = ref(true)

const toggle = () => {
  checked.value = !checked.value
}

const teacher = usePage().props.teacher;

const form = useForm({
  name: teacher.data.name,
  email: teacher.data.email,
  phone: teacher.data.phone,
  date_of_recruit: teacher.data.date_of_recruit,
  base_salary: teacher.data.base_salary,
  specialty: teacher.data.specialty
});

const submit = () => {
  form.put(route("teachers.update", teacher.data.id), {
        preserveScroll: true,
    });
};
</script>

<template>

  <Head title="teachers" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Teachers
      </h2>
    </template>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-lg font-medium leading-6 text-gray-900">
                Teacher Information
              </h3>
              <p class="mt-1 text-sm text-gray-500">
                Use this form to modify the teachers details.
              </p>
            </div>
            <div class="mx-2">

              <button type="button" @click="toggle"
                class="px-3 py-2 text-sm font-bold leading-4 text-white whitespace-nowrap bg-indigo-600 rounded"
                :class="{ 'bg-gray-300 text-gray-800': !checked }">
                <span v-if="!checked">View</span>
                <span v-if="checked">Edit</span>
              </button>
            </div>
          </div>
          <form @submit.prevent="submit">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                <div class="flex justify-end">
                  <!-- view only -->
                  <svg v-if="checked === true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                  <!-- edit -->
                  <svg v-if="checked === false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                  </svg>

                </div>
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input v-model="form.name" type="text" id="name"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.name,
                      }" :disabled="checked" />
                    <InputError class="mt-2" :message="form.errors.name" />
                  </div>

                  <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                      Address</label>
                    <input v-model="form.email" type="email" id="email" autocomplete="email"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.email,
                      }" :disabled="checked" />
                    <InputError class="mt-2" :message="form.errors.email" />
                  </div>

                  <!-- phone -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input v-model="form.phone" type="tel" id="phone"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      placeholder="+2490123456789" :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.phone,
                      }" required :disabled="checked" />
                    <InputError class="mt-2" :message="form.errors.phone" />
                  </div>
                  <!-- dateOfRecruit -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="date_of_recruit" class="block text-sm font-medium text-gray-700">Date of recruit</label>
                    <input v-model="form.date_of_recruit" type="date" id="date_of_recruit" name="date_of_recruit"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.date_of_recruit,
                      }" required :disabled="checked" />
                    <InputError class="mt-2" :message="form.errors.date_of_recruit" />
                  </div>
                  <!-- base_salary -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="base_salary" class="block text-sm font-medium text-gray-700">Salary</label>
                    <input v-model="form.base_salary" type="text" id="base_salary" name="base_base_salary"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      placeholder="$40.000" :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.base_salary,
                      }" required :disabled="checked" />
                    <InputError class="mt-2" :message="form.errors.base_salary" />
                  </div>
                  <!-- specialty -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="specialty" class="block text-sm font-medium text-gray-700">Specialty</label>
                    <input v-model="form.specialty" type="text" id="specialty"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      placeholder="Arabic | English ..etc" :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.specialty,
                      }" required :disabled="checked" />
                    <InputError class="mt-2" :message="form.errors.specialty" />
                  </div>
                </div>
              </div>
              <div v-if="!checked" class="px-4 py-3 text-right bg-gray-100 sm:px-6">
                <Link :href="route('teachers.index')"
                  class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-md border border-transparent hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
                </Link>
                <button type="submit"
                  class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                  Save
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
