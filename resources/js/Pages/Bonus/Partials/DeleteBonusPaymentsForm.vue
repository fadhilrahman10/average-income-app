<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm, usePage} from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingBonusDeletion = ref(false);
const id = usePage().props.bonusPayment.id;

const form = useForm({});

const confirmUserDeletion = () => {
    confirmingBonusDeletion.value = true;
};

const deleteBonus = () => {
    form.delete(route('bonus-payments.destroy', id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: (err) => console.log(err),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingBonusDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Bonus Payments</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your bonus is deleted, all of its resources and data will be permanently deleted. Before deleting
                your bonus payments, please download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Delete Bonus Payments</DangerButton>

        <Modal :show="confirmingBonusDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your bonus is deleted, all of its resources and data will be permanently deleted. Please
                    to confirm you would like to permanently delete your bonus payments.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteBonus"
                    >
                        Delete Bonus Payments
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
