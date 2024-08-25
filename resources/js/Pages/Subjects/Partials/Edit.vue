<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const confirmingNameAddition = ref(false);

const props = defineProps({
  subject: {
    type: Object,
    required: true
  }
});
const subject = props.subject;
const form = useForm({
  name: subject.name,
  full_mark: subject.full_mark,
  class_id: subject.class.id,
});

const confirmPostSubmit = () => { confirmingNameAddition.value = true; };

const editSubject = () => {
  form.put(route("subjects.update", subject.id), {
    onSuccess: () => closeModal(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  confirmingNameAddition.value = false;
  form.reset();
};
</script>

<template>
  <section class="space-y-6">
    <!-- show model button -->
    <button
      class="inline-flex justify-center items-center mr-2  text-sm font-medium text-indigo-600 hover:text-indigo-900"
      @click="confirmPostSubmit">
      Edit
    </button>

    <Modal :show="confirmingNameAddition" @close="closeModal">
      <div class="p-4">
        <h4>ClassRoom {{ subject.class.id }}</h4>
        <form @submit.prevent="editSubject">
          <!-- subject name input -->
          <div class="mt-6">
            <InputLabel for="name" value="Name" class="sr-only" />

            <input v-model="form.name" type="text" id="name"
              class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              :class="{
                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                  form.errors.name,
              }" required />

            <InputError :message="form.errors.name" class="mt-2" />
          </div>
          <!-- subject full marks -->
          <div class="mt-6">
            <InputLabel for="full_mark" value="Full Mark" class="sr-only" />

            <input type="number" v-model="form.full_mark" id="full_mark" name="full_mark"
              class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              :class="{
                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                  form.errors.full_mark,
              }" required />
            <InputError :message="form.errors.full_mark" class="mt-2" />
          </div>

          <div class="flex mt-6">
            <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
            <button class="ms-3 btn-indigo" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
              type="submit">
              Edit Subject
            </button>
          </div>
        </form>
      </div>
    </Modal>
  </section>
</template>
