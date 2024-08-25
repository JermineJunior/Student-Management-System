<script setup>
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";

defineProps({
    students: {
        type: Object,
    },
    classes: {
        type: Object,
        required: true,
    },
});
/**Start Search functionality */
//capture the user`s search value
let pageNumber = ref(1),
    searchTerm = ref(usePage().props.search ?? ""),
    class_id = ref(usePage().props.class_id ?? "");

const pageNumberUpdated = (link) => {
    pageNumber.value = link.url.split("=")[1];
};

let studentsUrl = computed(() => {
    //build the current url
    const url = new URL(route("students.index"));

    /**
     * reseating the page number to view the
     *  returned search data
     */
    url.searchParams.set("page", pageNumber.value);

    if (searchTerm.value) {
        url.searchParams.set("search", searchTerm.value);
    }

    if (class_id.value) {
        url.searchParams.append("class_id", class_id.value);
    }

    return url;
});

watch(
    () => studentsUrl.value,
    (newValue) => {
        router.visit(newValue, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    },
);
//when the user searches we return the results from the first page
watch(
    () => searchTerm.value,
    (value) => {
        if (value) {
            pageNumber.value = 1;
        }
    },
);

const clearFilters = () => {
    searchTerm.value = "";
    class_id.value = 0;
};

const deleteForm = useForm({});

const deleteStudent = (id) => {
    if (confirm("Are you sure you want to delete this student?")) {
        deleteForm.delete(route("students.destroy", id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>

    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Students
            </h2>
        </template>
        <div class="py-10 bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Students
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Students.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('students.create')"
                                class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Add Student
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-col justify-start mt-6 sm:flex-row">
                        <div class="relative col-span-3 text-sm text-gray-800">
                            <div
                                class="flex absolute top-0 bottom-0 left-0 items-center pl-2 text-gray-500 pointer-events-none">
                                <MagnifyingGlass />
                            </div>

                            <input type="text" v-model="searchTerm" placeholder="Search students data..." id="search"
                                class="block py-2 pl-10 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>

                        <select v-model="class_id"
                            class="block py-2 ml-5 text-gray-900 rounded-lg border-0 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 sm:text-sm sm:leading-6">
                            <option :value="0">Filter By Class</option>
                            <option :value="item.id" :key="item.id" v-for="item in classes.data">
                                {{ item.name }}
                            </option>
                        </select>
                        <button @click="clearFilters" class="mx-3 text-sm text-gray-700">
                            clear all
                        </button>
                    </div>

                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto -mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                            <div class="inline-block py-2 min-w-full align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden relative ring-1 ring-black ring-opacity-5 shadow md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    NO
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pr-3 pl-4 text-sm font-semibold text-left text-gray-900 sm:pl-6">
                                                    Email
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                                    Parent
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                                    Class
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-sm font-semibold text-left text-gray-900">
                                                    Created At
                                                </th>
                                                <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6" />
                                            </tr>
                                        </thead>
                                        <div v-if="students.data.length == 0"
                                            class="p-2 m-4 rounded-lg bg-yellow-500/10">
                                            <p class="italic font-bold text-gray-800">
                                                NO Results Found!
                                            </p>
                                        </div>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="(student, index) in students.data" :key="student.id"
                                                class="transition-colors duration-300 ease-in-out hover:bg-gray-200">
                                                <td
                                                    class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    {{ student.id }}
                                                </td>
                                                <td
                                                    class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    {{ student.name }}
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ student.email }}
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ student.parent.parent_name }}
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ student.class.name }}
                                                </td>

                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{
                                                        student.created_at_formatted
                                                    }}
                                                </td>

                                                <td
                                                    class="relative py-4 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                                    <Link :href="route('students.show', student.id)
                                                        " class="text-indigo-600 hover:text-indigo-900">
                                                    View
                                                    </Link>
                                                    <button @click="
                                                        deleteStudent(
                                                            student.id,
                                                        )
                                                        " class="ml-2 text-red-500 hover:text-red-700">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <Pagination v-if="students.data.length !== 0" :data="students"
                                    :pageNumberUpdated="pageNumberUpdated" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
!
