<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { watch, ref } from "vue";
import axios from "axios";

defineProps({
  classes: {
    type: Object,
  },
});

const form = useForm({
  name: "",
  email: "",
  class_id: "",
  section_id: "",
});

let sections = ref({})

watch(() => form.class_id,
  (newValue) => {
    getSections(newValue);
  })

const getSections = (classId) => {
  axios.get("/api/sections?class_id=" + classId)
    .then((response) => {
      sections.value = (response.data);
    });
}

const submit = () => {
  form.post(route('teachers.store'));
};
</script>

<template>

  <Head title="Add teachers" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        teachers [Add]
      </h2>
    </template>
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <form @submit.prevent="submit">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                <div>
                  <h3 class="text-lg font-medium leading-6 text-gray-900">
                    teacher Information
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Use this form to create a new teacher.
                  </p>
                </div>

                <div class="grid grid-cols-6 gap-6">
                  <!-- name -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input v-model="form.name" type="text" id="name"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      placeholder="Ali Kareem" :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.name,
                      }" required />
                    <InputError class="mt-2" :message="form.errors.name" />
                  </div>
                  <!-- email -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                      Address</label>
                    <input v-model="form.email" type="email" id="email" autocomplete="email"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      placeholder="example@email.com" :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.email,
                      }" required />
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
                      }" required />
                    <InputError class="mt-2" :message="form.errors.phone" />
                  </div>
                  <!-- dateOfRecruit -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="date_of_recruit" class="block text-sm font-medium text-gray-700">Date of recruit</label>
                    <input v-model="form.date_of_recruit" type="date" id="date_of_recruit"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.date_of_recruit,
                      }" required />
                    <InputError class="mt-2" :message="form.errors.date_of_recruit" />
                  </div>
                  <!-- salary -->
                  <div class="col-span-6 sm:col-span-3">
                    <label for="base_salary" class="block text-sm font-medium text-gray-700">Salary</label>
                    <input v-model="form.base_salary" type="text" id="base_salary"
                      class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      placeholder="$40.000" :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                          form.errors.base_salary,
                      }" required />
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
                      }" required />
                    <InputError class="mt-2" :message="form.errors.specialty" />
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 text-right bg-gray-100 sm:px-6">
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
