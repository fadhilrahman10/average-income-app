<script setup>
import {Link, usePage} from "@inertiajs/vue3";

const links = usePage().props.bonusPayments.links;
</script>

<template>
    <div class="flex m-4 float-end">
        <!-- Previous Button -->
        <Component
            :is="link.url ? 'a' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            :class="{ 'bg-gray-800 border border-transparent hover:bg-gray-700 text-white hover:text-white': link.active }"
        />
<!--        <Link @click="prevPage" class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">-->
<!--            <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">-->
<!--                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>-->
<!--            </svg>-->
<!--            Previous-->
<!--        </Link>-->
<!--        <Link :href="next" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700">-->
<!--            Next-->
<!--            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">-->
<!--                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>-->
<!--            </svg>-->
<!--        </Link>-->
    </div>
</template>

<style scoped>

</style>
