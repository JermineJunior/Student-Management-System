<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingNameAddition = ref(false);
const nameInput = ref(null);

const form = useForm({
  name: '',
});

const confirmPostSubmit = () => {
  confirmingNameAddition.value = true;

  nextTick(() => nameInput.value.focus());
};

const addClass = () => {
  form.post(route('classes.store'), {
    onSuccess: () => closeModal(),
    onError: () => nameInput.value.focus(),
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

    <button
      class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
      @click="confirmPostSubmit">
      Add Class
    </button>

    <Modal :show="confirmingNameAddition" @close="closeModal">
      <div class="p-6">
        <div class="mt-6">
          <InputLabel for="name" value="Name" class="sr-only" />

          <TextInput id="name" ref="nameInput" v-model="form.name" type="text" class="block mt-1 w-3/4"
            placeholder="Class Name" />

          <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <div class="flex mt-6">
          <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

          <button class="ms-3 btn-indigo" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
            @click="addClass">
            Add Class
          </button>
        </div>
      </div>
    </Modal>
  </section>
</template>
