<script setup>
import {usePage, Link} from "@inertiajs/vue3";

const bonusPayments = usePage().props.bonusPayments.data;
// prev_page_url
console.log(usePage().props.bonusPayments.next_page_url);
</script>

<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Percentage
                </th>
                <th scope="col" class="px-6 py-3">
                    Bonus
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b" v-for="bonus in bonusPayments">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                    <div class="ps-3">
                        <div class="text-base font-semibold">{{ bonus.name }}</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    {{ Number(bonus.percentage) }} %
                </td>
                <td class="px-6 py-4">
                    {{ bonus.total }}
                </td>
                <td class="px-6 py-4">
                    {{ bonus.payments }}
                </td>
                <td class="px-6 py-4">
                    <Link
                        :href="route('bonus-payments.edit', bonus.id)"
                        class="font-medium text-blue-600 hover:underline transition duration-150 ease-in-out"
                    >
                        Edit
                    </Link>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
