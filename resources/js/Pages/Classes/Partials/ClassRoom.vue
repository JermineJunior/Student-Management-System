<script setup >
import { ref }  from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

let props = defineProps({
    classRoom: {
        type: Object,
    },
    index: {
        type : Number,
    }
});

let editing = ref(false)

let Class = props.classRoom;

const form = useForm({
  name: Class.name
})

</script>

<template>
  <tr class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
    <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
      {{ props.index + 1 }}
    </td>
    <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
     <template v-if="editing">
         <InputLabel for="name" value="Class Name" class="sr-only" />
            <TextInput v-model="form.name" id="name"
              class="block px-3 py-3 my-3 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
             :class="{
            'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
              form.errors.name,
          }" required />
             <InputError class="mt-2" :message="form.errors.name" />
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
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
      </svg>
      {{ Class.subjects.length }}
      </Link>
    </td>
    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
      {{ Class.students }}
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