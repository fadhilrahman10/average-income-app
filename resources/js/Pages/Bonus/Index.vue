<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import TableBonusPayments from "@/Pages/Bonus/Partials/TableBonusPayments.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchEmplyeeForm from "@/Pages/Bonus/Partials/SearchEmplyeeForm.vue";

defineProps(['bonusPayments'])
</script>

<template>
    <Head title="Bonus Payments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bonus Payments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white">
                            <div>
                                <Link
                                    :href="route('bonus-payments.create')"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                >
                                    Create Bonus
                                </Link>
                            </div>

<!--                            <SearchEmplyeeForm />-->
                        </div>

                        <TableBonusPayments />

                        <Pagination @next="" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
