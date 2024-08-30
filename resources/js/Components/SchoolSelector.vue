<template>
  <VDropdown :distance="10">
    <button class="flex items-center px-2 py-px ">
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
        <li class="py-1 hover:bg-gray-200" v-for="school in schools" :key="school.id">
          <Link class="px-4 py-2 text-sm block text-gray-500" :href="`/dashboard/${school.id}`">
         
          {{ school.name }}
          </Link>
        </li>
        <li>
          <button @click="hide();" class=" w-full text-left block px-3 py-2 text-indigo-600 hover:bg-gray-200 ">Add a
            School</button>
        </li>
      </ul>
    </template>
  </VDropdown>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';

let page = usePage();

let schools = page.props.schools.data
</script>