<script setup>
import { ref, watch } from 'vue';
import { Link, useForm, router } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import debounce from 'lodash.debounce';

let props = defineProps({
    classRoom: {
        type: Object,
    },
    index: {
        type: Number,
    }
});

let editing = ref(false)

let Class = props.classRoom;

const editingForm = useForm({
    name: Class.name
});

const exportStudents = (classId) => {
    if(confirm('Do you want to Export the ClassRoom Students')){
        window.location.href = `/export/class/${classId}`
    }
}

let editName = debounce(() => {
    editingForm.patch(`/classes/${Class.id}`, {
        onSuccess: () => {
            router.visit(route('classes.index'))
        },
         preserveScroll: true,
    })
}, 700);


watch(() => editingForm.isDirty, () => {
    editName()
})
const deleteForm = useForm({});

const deleteClass = (id) => {
    if (confirm("Are you sure you want to delete this class?")) {
        deleteForm.delete(route("classes.destroy", id), {
            preserveScroll: true,
        });
    }
};

</script>

<template>
    <tr class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
            {{ props.index + 1 }}
        </td>
        <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
            <template v-if="editing">
                <InputLabel for="name" value="Class Name" class="sr-only" />
                <TextInput v-model="editingForm.name" id="name"
                    class="w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    :class="{
                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                            editingForm.errors.name,
                    }" required />
                <InputError class="mt-2" :message="editingForm.errors.name" />
            </template>
            <template v-else>
                {{ Class.name }}
            </template>
        </td>
        <td class="py-4 text-sm font-medium text-gray-900 whitespace-nowrap x-5 sm:pl-6">
            <Link :href="route('subjects.show', Class.id)" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="mx-[2px] size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            {{ Class.subjects.length }}
            </Link>
        </td>
        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
            {{ Class.students }}
        </td>
        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
            <button @click="exportStudents(Class.id)" class="text-indigo-600 hover:text-indigo-800">
                <svg class="size-7" viewBox="-1.44 -1.44 26.88 26.88" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12" stroke="#5e69a1" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 14L12 4M12 4L15 7M12 4L9 7" stroke="#5e69a1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </button>
        </td>
        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
            <Link class="text-indigo-600 hover:text-indigo-800" :href="route('attendance.showForm', Class.id)">
            <svg class="size-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#4F46E5" stroke="#4F46E5"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="none" fill-rule="evenodd" stroke="" stroke-linecap="round" stroke-linejoin="round" transform="translate(4 3)"> <path d="m3.5 1.5c-.42139382 0-1.08806048 0-2 0-.55228475 0-1 .44771525-1 1v11c0 .5522848.44771525 1 1 1h10c.5522847 0 1-.4477152 1-1v-11c0-.55228475-.4477153-1-1-1-.8888889 0-1.55555556 0-2 0"></path> <path d="m4.5.5h4c.55228475 0 1 .44771525 1 1s-.44771525 1-1 1h-4c-.55228475 0-1-.44771525-1-1s.44771525-1 1-1z"></path> <path d="m5.5 5.5h5"></path> <path d="m5.5 8.5h5"></path> <path d="m5.5 11.5h5"></path> <path d="m2.5 5.5h1"></path> <path d="m2.5 8.5h1"></path> <path d="m2.5 11.5h1"></path> </g> </g></svg>
            </Link>
        </td>
        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
            {{ Class.addedOn }}
        </td>
        <td class="relative py-4 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
            <button @click="editing = !editing" class="text-indigo-600 hover:text-indigo-900">
                <span v-if="editing">Done</span>
                <span v-else>Edit</span>
            </button>
            <button @click="
                deleteClass(
                    Class.id,
                )
                " class="ml-2 text-red-500 hover:text-red-700">
                Delete
            </button>
        </td>
    </tr>
</template>