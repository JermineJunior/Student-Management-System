<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
  Class: {
    type: Object,
    required: true
  }
});

const form = useForm({
  'name': Class.data.name
})
</script>


<template>

  <Head title="Classes" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Classes / Edit</h2>
    </template>

    <sec class="space-y-6">
      <div class="p-6">
        <div class="mt-6">
          <InputLabel for="name" value="Name" class="sr-only" />

          <TextInput id="name" v-model="form.name" type="text" class="block mt-1 w-3/4" placeholder="Class Name" />

          <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <div class="flex mt-6">
          <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

          <button class="ms-3 btn-indigo" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
            @click="updateClass">
            Add Class
          </button>
        </div>
      </div>
    </sec>
  </AuthenticatedLayout>
</template>