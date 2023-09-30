<script setup>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AddSlotModal from "@/Components/AddSlotModal.vue";

import { ref, computed } from "vue";
import { reactive } from "vue";
const user = computed(() => usePage().props.auth.user);
const appointmentData = computed(() => usePage().props.data);
const services = computed(() => usePage().props.service);
const error = computed(() => usePage().props.errors);

let form_data = reactive(null);



const props = defineProps({
    label: {
        type: String,
        default: "Appointment",
    },
    data: {
        type: Object,
        default: null,
    }
});

let form = useForm({
    id: props.data.id,
    date: props.data.date,
    time_start: props.data.time_start,
    time_end: props.data.time_end,
    status: props.data.status,
    type: props.data.id,
    service_id: props.data.service_id,
    payment_status: props.data.payment_status,
    type: props.data.type,
});

const isModalShow = ref(false);

const deleteTime = (data) => {
    form.delete(route("customer-apointment.destroy", data));
};

const openModal = () => {
    form_data = null;
    isModalShow.value = true;
};
const closeMOdal = () => {
    isModalShow.value = false;
};
</script>

<template>
    <AddSlotModal
        @close="closeMOdal"
        :data="form"
        :service="form_data"
        :show="isModalShow"
       
    >
    </AddSlotModal>

    <a
        href="javascript:void(0);"
        class="btn btn-primary bg-green py-md-3 px-md-5 me-3"
        @click="openModal"
        type="button"
        >{{ props.label }}</a
    >
</template>
