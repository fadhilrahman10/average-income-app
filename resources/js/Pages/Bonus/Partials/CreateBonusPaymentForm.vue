<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const form = useForm({
    bonus: null,
    employees: [
        {
            name: '',
            percent: null,
            total: null
        },
        {
            name: '',
            percent: null,
            total: null
        },
        {
            name: '',
            percent: null,
            total: null
        },
    ],
});

const err = ref(false);

const save = () => {
    const totalPercent = form.employees.reduce((total, item) => {
        return Number(total) + Number(item.percent);
    }, 0);

    if (totalPercent !== 100) {
        err.value = true;
        return;
    }

    form.post(route('bonus-payments.store'), {
        preserveScroll: true,
        onSuccess: () => location.href = route('bonus-payments'),
        onError: () => err.value = true,
        onFinish: () => form.reset(),
    })
}

const addEmployee = () => {
    form.employees.push({ name: "", percent: null, total: null });
}

const removeEmployee = (employee) => {
    form.employees.splice(employee, 1);
}

const checkBonus = (employee) => {
    employee.total = (employee.percent / 100) * form.bonus;
}
</script>

<template>

    <InputError v-if="err" message="pembagian bonus masih salah." class="mt-2"></InputError>

    <div class="my-4">
        <InputLabel for="bonus" value="Bonus" class="sr-only" />

        <TextInput
            id="bonus"
            v-model="form.bonus"
            type="number"
            class="mt-1 block w-3/4"
            placeholder="Pembayaran dalam rupiah"
            min="0"
        />
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                    Employee
                </th>
                <th scope="col" class="px-6 py-3">
                    Percent
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white" v-if="form.bonus > 0" v-for="(employee, index) in form.employees">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <InputLabel :for="`employee-${index}`" value="Employee" class="sr-only" />

                    <TextInput
                        :id="`employee-${index}`"
                        v-model="form.employees[index].name"
                        type="text"
                        class="mt-1 block w-3/4"
                        placeholder="Employee"
                    />
                </th>
                <td class="px-6 py-4">
                    <InputLabel :for="`percent-${index}`" value="Percent" class="sr-only" />

                    <TextInput
                        :id="`percent-${index}`"
                        v-model="form.employees[index].percent"
                        type="number"
                        class="mt-1 block w-3/4"
                        placeholder="Percent"
                        max="100"
                        min="0"
                        @keyup="checkBonus(employee)"
                    />
                </td>
                <td class="px-6 py-4 gap-2">
                    <DangerButton
                        v-if="form.employees.length > 3"
                        @click="removeEmployee(employee)"
                    >
                        -
                    </DangerButton>
                </td>
                <td class="px-6 py-4">
                    {{ employee.total ?? '-' }}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr v-if="form.bonus > 0" class="font-semibold text-gray-900">
                <td colspan="3"></td>
                <td class="px-6 py-3">
                    <PrimaryButton @click="addEmployee" class="mr-3">Add</PrimaryButton>
                    <SecondaryButton @click="save">Save</SecondaryButton>
                </td>
            </tr>
        </tfoot>
    </table>
</template>

<style scoped>

</style>
