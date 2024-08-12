<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    data: {
        type: Object,
    },
    pageNumberUpdated: {
        type: Function,
        required: true
    }
});

const updatePageNumber = (link) => {
    let pageNumber = link.url.split("=")[1];

    router.visit(`/students?&page=${pageNumber}`, {
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="py-6 mx-auto max-w-7xl">
        <div class="mx-auto max-w-none">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                    <div class="flex flex-1 justify-between sm:hidden" />
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <!-- space -->
                                <span class="font-medium">{{
                                    data.meta.from
                                }}</span>
                                <!-- space -->
                                to
                                <!-- space -->
                                <span class="font-medium">{{
                                    data.meta.to
                                }}</span>
                                <!-- space -->
                                of
                                <!-- space -->
                                <span class="font-medium">{{
                                    data.meta.total
                                }}</span>
                                <!-- space -->
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="inline-flex relative z-0 -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <button v-for="(link, index) in data.meta.links" :key="index"
                                    @click.prevent="pageNumberUpdated(link)" :disabled="link.active || !link.url"
                                    class="inline-flex relative items-center px-4 py-2 text-sm font-medium border" :class="{
                                        'z-10 bg-indigo-50 border-indigo-500 text-indigo-600':
                                            link.active,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50':
                                            !link.active,
                                    }">
                                    <span v-html="link.label"></span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
