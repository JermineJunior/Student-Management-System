<template>

  <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
    {{ school.id }}
  </td>
  <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
    {{ school.name }}
  </td>
  <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
    1000
  </td>
  <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
    {{ school.status_label }}
  </td>
  <td class="relative py-4 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
    <button class="text-indigo-600 hover:text-indigo-900">
      Edit
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

const props = defineProps({
  school: {
    type: Object,
    required: true
  }
});


const deleteSchool = (id) => { }

</script>