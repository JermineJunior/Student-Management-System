<template>
    <div>

        <Head title="Students" />
        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students</h2>
            </template>
            <div class="py-3">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between mb-6">
                        <search-filter class="w-full max-w-md mr-4" />
                        <Link class="btn-indigo" href="/students/create">
                        <span>Create</span>
                        <span class="hidden md:inline">&nbsp;Students</span>
                        </Link>
                    </div>
                    <div class="overflow-x-auto bg-white rounded-md shadow">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-indigo-300/10 ">
                                <tr class="font-bold text-left">
                                    <th class="px-3 pt-6 pb-4">No</th>
                                    <th class="px-3 pt-6 pb-4">Name</th>
                                    <th class="px-3 pt-6 pb-4">Email</th>
                                    <th class="px-3 pt-6 pb-4">Class</th>
                                    <th class="px-3 pt-6 pb-4">Added On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="student in students.data" :key="student.id"
                                    class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t">
                                        <p class="flex items-center px-3 py-4 focus:text-indigo-500">
                                            {{ student.id }}
                                        </p>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex items-center px-3 py-4 focus:text-indigo-500"
                                            :href="`/students/${student.id}/edit`">
                                        {{ student.name }}
                                        <icon v-if="student.deleted_at" name="trash"
                                            class="w-3 h-3 ml-2 shrink-0 fill-gray-400" />
                                        </Link>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex items-center px-3 py-4" :href="`/students/${student.id}/edit`"
                                            tabindex="-1">
                                        {{ student.email }}
                                        </Link>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex items-center px-3 py-4" :href="`/students/${student.id}/edit`"
                                            tabindex="-1">
                                        {{ student.class_id.name }}
                                        </Link>
                                    </td>
                                    <td class="border-t">
                                        <Link class="flex items-center px-3 py-4" :href="`/students/${student.id}/edit`"
                                            tabindex="-1">
                                        {{ student.created_at }}
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="students.data.length === 0">
                                    <td class="px-6 py-4 border-t" colspan="4">No students found.</td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination class="mt-6" :links="students.links" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3'
import icon from '@/Components/Icon.vue';
import SearchFilter from '@/Components/SearchFilter.vue'
import pagination from '@/Components/Pagination.vue'

defineProps({
    students: {
        type: Object,
        required: true
    }
})
</script>

