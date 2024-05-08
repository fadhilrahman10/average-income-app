<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm, usePage} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";

const bonus = usePage().props.bonusPayment;

console.log(bonus);

const form = useForm({
    name: bonus.name,
    percentage: Number(bonus.percentage),
    total: bonus.total,
    payments: bonus.payments,
})

const updateBonus = () => {
    form.total = (form.percentage / 100) * form.payments;

    form.put(route('bonus-payments.update', bonus.id))
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Bonus Payments Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your Bonus Payments information.
            </p>
        </header>

        <form @submit.prevent="updateBonus" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-3/4"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="percentage" value="Percentage" />

                <div class="w-full">
                    <TextInput
                        id="percentage"
                        type="number"
                        class="mt-1 w-3/4"
                        v-model="form.percentage"
                        autofocus
                        autocomplete="percentage"
                    />
                    <span class="ms-3">%</span>
                </div>

                <InputError class="mt-2" :message="form.errors.percentage" />
            </div>

            <div>
                <InputLabel for="total" value="Total" />

                <div class="w-full">
                    <TextInput
                        id="total"
                        type="number"
                        class="mt-1 w-3/4"
                        v-model="form.total"
                        readonly
                        autofocus
                        autocomplete="total"
                    />
                    <span class="ms-3">IDR</span>
                </div>

                <InputError class="mt-2" :message="form.errors.total" />
            </div>

            <div>
                <InputLabel for="payments" value="Payments" />

                <div class="w-full">
                    <TextInput
                        id="payments"
                        type="number"
                        class="mt-1 w-3/4"
                        v-model="form.payments"
                        readonly
                        autofocus
                        autocomplete="payment"
                    />
                    <span class="ms-3">IDR</span>
                </div>

                <InputError class="mt-2" :message="form.errors.payments" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style scoped>

</style>
