<template>
    <VDropdown :distance="10" :auto_hide="true">
        <button class="flex items-center px-2 py-px">
            <span class="text-gray-500 font-semibold">Select a School</span>
            <svg class="-me-0.5 h-4 w-4 fill-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <template #popper="{ hide }">
            <ul class="py-4">
                <li class="py-1 flex items-center space-x-2 hover:bg-gray-200" v-for="school in schools"
                    :key="school.id">
                    <button @click="activate(school.id)" class="px-4 py-2 text-sm block text-gray-500"
                        :disabled="school.status === 1">
                        {{ school.name }}
                    </button>
                    <svg v-if="school.status === 1" class="w-5 h-5 fill-green-600" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M12 20V17.6M12 6.4V4M20 12H17.6M6.4 12H4M17.6569 6.34315L15.9598 8.0402M8.0402 15.9598L6.34315 17.6569M6.34293 6.34332L8.03999 8.04038M15.9596 15.96L17.6566 17.657"
                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                        </g>
                    </svg>
                </li>
                <li>
                    <button @click="hide()" class="w-full text-left block px-3 py-2 text-indigo-600 hover:bg-gray-200">
                        Add a School
                    </button>
                </li>
            </ul>
        </template>
    </VDropdown>
</template>
<script setup>
import { useForm, router } from "@inertiajs/vue3";
import { hideAllPoppers } from "floating-vue";

const props = defineProps({
    schools: Object
})

let schools = props.schools

const activateForm = useForm({});
const activate = (id) => {
    if (confirm("Activate this school?")) {
        activateForm.patch(route('schools.edit', id), {
            onFinish: () => {
                hideAllPoppers();
                router.visit(route('dashboard'));
            }
        });
    }
};
</script>
