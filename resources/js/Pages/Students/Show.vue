<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
  student: {
    type: Object,
  },
});

</script>
<template>

  <Head title="Students" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Student Details
      </h2>
    </template>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
              <h2 class="text-2xl">Student Information</h2>
              <div class="flex items-start">
                <!-- student info -->
                <div class="mx-6">
                  <p>Name : <span class="font-semibold"> {{ student.data.name }}</span></p>
                  <p>Email : <span class="font-semibold"> {{ student.data.email }}</span></p>
                  <p>class : <span class="font-semibold"> {{ student.data.class.name }}</span></p>
                  <p>Date of Registration : <span class="font-semibold"> {{ student.data.created_at_formatted }}</span>
                  </p>
                </div>
                <!-- student parent info -->
                <div class="mx-6">
                  <div>
                    Parent Name : <span class="font-semibold"> {{ student.data.parent.parent_name }}</span>
                  </div>
                  <div>
                    Parent Email : <span class="font-semibold"> {{ student.data.parent.parent_email }}</span>
                  </div>
                  <div>
                    Parent contact : <span class="font-semibold"> {{ student.data.parent.phone }}</span>
                  </div>
                  <div>
                    Parent Address : <span class="font-semibold"> {{ student.data.parent.address }}</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- controls -->
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
              <Link :href="route('students.index')"
                class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-md border border-transparent hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Go back
              </Link>
              <Link :href="route('students.edit', student.data.id)"
                class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Edit
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>