<template>
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
        {{ id + 1 }}
    </td>
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
        <template v-if="editing">
            <InputLabel for="name" class="sr-only" value="School Name" />
            <TextInput id="name" class="" v-model="editingForm.name" />
        </template>
        <template v-else>
            {{ school.name }}
        </template>
    </td>
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
        {{ school.students }}
    </td>
    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
        {{ school.status_label }}
    </td>
    <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
        <button @click="editing = !editing" class="text-indigo-600 hover:text-indigo-900">
            <span v-if="editing">Done</span>
            <span v-else>Edit</span>
        </button>
        <button @click="
            deleteSchool(
                school.id,
            )
            " class="ml-2 text-red-500 hover:text-red-700">
            Delete
        </button>
    </td>

</template>

<script setup>
import { ref, watch } from 'vue';
import TextInput from '../TextInput.vue';
import InputLabel from '../InputLabel.vue';
import { useForm, router } from '@inertiajs/vue3';
import debounce from 'lodash.debounce';
const props = defineProps({
    school: {
        type: Object,
        required: true
    },
    students: {
        type: Number,
    },
    id: {
        type: Number,
        required: true
    },
});
// handle inline editing
const editing = ref(false)

const editingForm = useForm({
    name: props.school.name
})

let editName = debounce(() => {
    editingForm.patch(route('schools.update', props.school.id), {
        preserveScroll: true,
    });
}, 500);
//watch the form for changes
watch(() => editingForm.isDirty, () => {
    editName()
});

const deleteForm = useForm({})
const deleteSchool = (id) => {
    if (confirm('Are you sure you want to delete this school?')) {
        deleteForm.delete(route('schools.destroy', id), {
            onSuccess: () => {
                router.visit(route('dashboard'));
            },
            preserveScroll: true,
        })
    }
}

</script>
