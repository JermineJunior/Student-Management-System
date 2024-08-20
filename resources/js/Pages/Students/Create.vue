<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";


defineProps({
    classes: {
        type: Object,
    },
});

const form = useForm({
    name: "",
    email: "",
    class_id: "",
    parent_name: "",
    parent_email: "",
    phone: "",
    address: "",
    house_number: ""
});


const submit = () => {
    form.post(route('students.store'));
};
</script>

<template>

    <Head title="Add Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Students [Add]
            </h2>
        </template>
        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="submit">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Student Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new student.
                                    </p>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <!--  student name -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input v-model="form.name" type="text" id="name"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.name,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                    <!-- student email -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email
                                            Address</label>
                                        <input v-model="form.email" type="email" id="email" autocomplete="email"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.email,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                    <!-- student class -->
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
                                            <option v-for="item in classes.data" :key="item.id" :value="item.id">
                                                {{ item.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.class_id" />
                                    </div>
                                    <!-- parent name -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="parent_name" class="block text-sm font-medium text-gray-700">Parent
                                            Name
                                        </label>
                                        <input v-model="form.parent_name" type="text" id="parent_name"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.parent_name,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.parent_name" />
                                    </div>
                                    <!-- parent phone -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Parent
                                            phone
                                        </label>
                                        <input type="tel" v-model="form.phone" id="phone" name="phone"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.phone,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.phone" />
                                    </div>
                                    <!-- parent email -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="parent_email" class="block text-sm font-medium text-gray-700">Email
                                            Address</label>
                                        <input v-model="form.parent_email" type="email" id="parent_email"
                                            autocomplete="parent_email"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.parent_email,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.parent_email" />
                                    </div>
                                    <!-- parent address -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Parent
                                            Address
                                        </label>
                                        <input type="text" v-model="form.address" id="address" name="address"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.address,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.address" />
                                    </div>
                                    <!-- parent house number -->
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="house_number" class="block text-sm font-medium text-gray-700">
                                            House Number
                                        </label>
                                        <input type="number" v-model="form.house_number" id="house_number"
                                            name="house_number"
                                            class="block px-3 py-2 mt-1 w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            :class="{
                                                'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                    form.errors.house_number,
                                            }" required />
                                        <InputError class="mt-2" :message="form.errors.house_number" />
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-100 sm:px-6">
                                <Link :href="route('students.index')"
                                    class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-indigo-700 bg-indigo-100 rounded-md border border-transparent hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                                </Link>
                                <button type="submit"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md border border-transparent shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
