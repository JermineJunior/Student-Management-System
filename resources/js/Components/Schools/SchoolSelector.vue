<template>
    <VDropdown :distance="10" :auto_hide="true">
        <button class="flex items-center px-2 py-px">
            <span class="font-semibold text-gray-500">Select a School</span>
            <svg class="-me-0.5 h-4 w-4 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <template #popper="{ hide }">
            <ul class="py-4">
                <li class="flex items-center px-2 py-1  space-x-2 hover:bg-gray-200" v-for="school in schools"
                    :key="school.id">
                    <button @click="activate(school.id)" class="block px-4 py-2 text-sm text-gray-500"
                        :disabled="school.status === 1">
                        {{ school.name }}
                    </button>
                    <svg v-if="school.status === 1" class="w-5 h-5 fill-indigo-600" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z"
                            fill="current" />
                    </svg>
                </li>
                <li>
                    <button @click="showCreateModal = true; hide();"
                        class="block w-full px-3 py-2 text-left text-indigo-600 hover:bg-gray-200">
                        Add a School
                    </button>
                </li>
            </ul>
        </template>
    </VDropdown>
    <!-- create school model -->
    <Modal :show="showCreateModal">
        <div class="relative mx-4 my-6">
            <h2 class="text-lg font-semibold leading-tight text-gray-800">Add a School</h2>
            <form @submit.prevent="createSchool" class="space-y-4 overflow-hidden">
                <InputLabel for="name" value="Name" class="sr-only" />
                <TextInput type="text" id="name" v-model="createForm.name" class="block w-full text-sm h-9"
                    placeholder="ex. Noon Middle School" :class="{ 'border-red-600': createForm.errors.name }" required />
                <InputError class="mt-2" :message="createForm.errors.name" />

                <div class="mt-4">
                    <InputLabel for="description" value="Description" />
                    <textarea id="description" v-model="createForm.description"
                        class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        rows="3" placeholder="Enter school description" required></textarea>
                    <InputError class="mt-2" :message="createForm.errors.description" />
                </div>
                <div class="flex items-center justify-end px-2">
                    <button @click="showCreateModal = false"
                        class="px-2 py-1 mr-3 text-red-500 rounded bg-gray-50 ">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add
                        School</button>
                </div>
            </form>
        </div>
    </Modal>
</template>
<script setup>
import TextInput from '../TextInput.vue';
import InputError from '../InputError.vue';
import InputLabel from '../InputLabel.vue';
import Modal from '../Modal.vue';
import PrimaryButton from '../PrimaryButton.vue';

import { useForm, router } from "@inertiajs/vue3";
import { hideAllPoppers } from "floating-vue";
import { ref } from "vue";

let showCreateModal = ref(false)
const props = defineProps({
    schools: Object
});

const createForm = useForm({
    name: '',
    description: ''
});

const createSchool = () => {
    createForm.post(route('schools.store'), {
        preserveScroll: true,
        onSuccess: () => {
            showCreateModal.value = false;
            createForm.reset();
            router.visit(route('dashboard'));
        },
        onError: () => {
            // Focus on the name input if there's an error
            document.getElementById('name').focus();
        },
    });
}
let schools = props.schools

const activateForm = useForm({});
const activate = (id) => {
    if (confirm("Activate this school?")) {
        activateForm.patch(`/schools/${id}/activate`, {
            onFinish: () => {
                hideAllPoppers();
                 router.visit(route('dashboard'));
            }
        });
    }
};
</script>
