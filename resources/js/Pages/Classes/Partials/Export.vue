<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm , router } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const props = defineProps({
    classes : Object
});

const confirmingNameAddition = ref(false);
const nameInput = ref(null);

const form = useForm({
  class_id: '',
});

const confirmPostSubmit = () => {
  confirmingNameAddition.value = true;

  //nextTick(() => nameInput.value.focus());
};

const exportStudents = () => {
    if(form.class_id){
         window.location.href = `/export/class/${form.class_id}`
         closeModal();
    }
};

const closeModal = () => {
  confirmingNameAddition.value = false;

  form.reset();
};
</script>

<template>
  <section class="space-y-6">

    <button
      class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-800 border-indigo-600 rounded-md border shadow-sm hover:bg-indigo-600 hover:text-white sm:w-auto"
      @click="confirmPostSubmit">
              Export Students
    </button>

    <Modal :show="confirmingNameAddition" @close="closeModal">
      <div class="p-6">
        <div class="col-span-6 sm:col-span-3">
            <label for="class_id"
                class="block text-sm font-medium text-gray-700">Class</label>
            <select v-model="form.class_id" id="class_id"
                class="block px-3 py-2 mt-1 w-full bg-white rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                :class="{
                    'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                        form.errors.class_id,
                }" required>
                <option value="">
                    Select a Class
                </option>
                <option v-for="item in classes" :key="item.id" :value="item.id">
                    {{ item.name }}
                </option>
            </select>
            <InputError class="mt-2" :message="form.errors.class_id" />
        </div>

        <div class="flex mt-6">
          <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

          <button class="ms-3 flex px-3 py-2 text-sm font-bold leading-4 bg-green-100 text-gray-800 border border-green-600 whitespace-nowrap  rounded" :class="{ 'opacity-25': form.processing }"
            @click="exportStudents"
            :disabled="!form.class_id">
             Export
                <svg class="size-4 ml-3" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><linearGradient id="a" x1="4.494" y1="-2092.086" x2="13.832" y2="-2075.914" gradientTransform="translate(0 2100)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#18884f"></stop><stop offset="0.5" stop-color="#117e43"></stop><stop offset="1" stop-color="#0b6631"></stop></linearGradient></defs><title>file_type_excel</title><path d="M19.581,15.35,8.512,13.4V27.809A1.192,1.192,0,0,0,9.705,29h19.1A1.192,1.192,0,0,0,30,27.809h0V22.5Z" style="fill:#185c37"></path><path d="M19.581,3H9.705A1.192,1.192,0,0,0,8.512,4.191h0V9.5L19.581,16l5.861,1.95L30,16V9.5Z" style="fill:#21a366"></path><path d="M8.512,9.5H19.581V16H8.512Z" style="fill:#107c41"></path><path d="M16.434,8.2H8.512V24.45h7.922a1.2,1.2,0,0,0,1.194-1.191V9.391A1.2,1.2,0,0,0,16.434,8.2Z" style="opacity:0.10000000149011612;isolation:isolate"></path><path d="M15.783,8.85H8.512V25.1h7.271a1.2,1.2,0,0,0,1.194-1.191V10.041A1.2,1.2,0,0,0,15.783,8.85Z" style="opacity:0.20000000298023224;isolation:isolate"></path><path d="M15.783,8.85H8.512V23.8h7.271a1.2,1.2,0,0,0,1.194-1.191V10.041A1.2,1.2,0,0,0,15.783,8.85Z" style="opacity:0.20000000298023224;isolation:isolate"></path><path d="M15.132,8.85H8.512V23.8h6.62a1.2,1.2,0,0,0,1.194-1.191V10.041A1.2,1.2,0,0,0,15.132,8.85Z" style="opacity:0.20000000298023224;isolation:isolate"></path><path d="M3.194,8.85H15.132a1.193,1.193,0,0,1,1.194,1.191V21.959a1.193,1.193,0,0,1-1.194,1.191H3.194A1.192,1.192,0,0,1,2,21.959V10.041A1.192,1.192,0,0,1,3.194,8.85Z" style="fill:url(#a)"></path><path d="M5.7,19.873l2.511-3.884-2.3-3.862H7.758L9.013,14.6c.116.234.2.408.238.524h.017c.082-.188.169-.369.26-.546l1.342-2.447h1.7l-2.359,3.84,2.419,3.905H10.821l-1.45-2.711A2.355,2.355,0,0,1,9.2,16.8H9.176a1.688,1.688,0,0,1-.168.351L7.515,19.873Z" style="fill:#fff"></path><path d="M28.806,3H19.581V9.5H30V4.191A1.192,1.192,0,0,0,28.806,3Z" style="fill:#33c481"></path><path d="M19.581,16H30v6.5H19.581Z" style="fill:#107c41"></path></g></svg>
          </button>
        </div>
      </div>
    </Modal>
  </section>
</template>
