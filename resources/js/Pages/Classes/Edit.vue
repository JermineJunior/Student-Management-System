<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from "@/Components/InputError.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
  Class: {
    type: Object,
    required: true
  }
});

const classroom = usePage().props.Class;

const form = useForm({
  name: classroom.data.name
})

const submit = () => {
  form.put(route("classes.update", classroom.data.id));
}
</script>


<template>

  <Head title="Classes" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Classes / Edit</h2>
    </template>

    <section class="space-y-6">
      <div class="container justify-center mx-auto">
        <div class="px-3 py-4 mt-3 max-w-2xl bg-white rounded shadow-md">
          <form @submit.prevent="submit">
            <InputLabel for="name" value="Class Name" />
            <TextInput v-model="form.name" id="name"
              class="block px-3 py-3 my-3 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              :class="{
                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                  form.errors.name,
              }" required />
            <InputError class="mt-2" :message="form.errors.name" />
            <div class="py-3 -mr-5 text-right sm:px-6">
              <Link :href="route('classes.index')"
                class="inline-flex items-center px-4 py-2 mr-2 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-md border border-transparent hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Cancel
              </Link>
              <button type="submit"
                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </AuthenticatedLayout>
</template>