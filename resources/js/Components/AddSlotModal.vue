<script setup>
import { defineProps, defineEmits, ref, computed, watch, onMounted } from "vue";
import toastr from "toastr";
import "toastr/build/toastr.css";
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

import TextInput from "@/Components/TextInput.vue";

const user = computed(() => usePage().props.auth.user);
const errors = computed(() => usePage().props.errors);
const service = computed(() => usePage().props.service);

const options = ref([
    { value: "New Appointment", label: "New Appointment" },
    { value: "Reschedule", label: "Reschedule" },
]);

let form = useForm({
    id: props.id,
    date: null,
    time_start: null,
    time_end: null,
    service_id: null,
    payment_status: "Partial",
    status: "Pending",
    type: null,
    user_id: user.value.id,
    // user_id: user.value.id,
});

const timeOptions = ref([
    { label: "08:00 AM", value: "08:00" },
    { label: "09:00 AM", value: "09:00" },
    { label: "10:00 AM", value: "10:00" },
    { label: "11:00 AM", value: "11:00" },
    { label: "12:00 PM", value: "12:00" },
    { label: "01:00 PM", value: "13:00" },
    { label: "02:00 PM", value: "14:00" },
    { label: "03:00 PM", value: "15:00" },
    { label: "04:00 PM", value: "16:00" },
]);
// onMounted(() => {
//      toastr.error('sdasd')
// });
const addSlotModal = ref(null);

const emit = defineEmits();
const props = defineProps({
    data: {
        type: Object,
        default: {},
    },
    message: {
        type: String,
        default: "Appointment",
    },

    show: {
        type: Boolean,
        default: false,
    },
});

watch([() => props.show, () => props.data], () => {
    if (props.show && props.data) {
        form = { ...form, ...props.data };
        openModal();
    } else if (props.show && !props.data) {
        openModal();
    }
});

function openModal() {
    addSlotModal.value.style.transform = "scale(1)";
    addSlotModal.value.style.display = "flex";
}
onMounted(() => {
    if (errors.value.date) {
        toastr.error(errors.value.date);
    }
});

function closeMOdal() {
    addSlotModal.value.style.transition = ".3s";
    addSlotModal.value.style.transform = "scale(0.1)";
    setTimeout(() => {
        addSlotModal.value.style.display = "none";
    }, 300);
    form.reset();
    emit("close");
}

const submit = () => {
    if (form.id != null) {
        form.patch(route("customer-apointment.update", { id: form.id }), {
            onError: (error) => {
                this.form.errors = error.errors;
            },
            onSuccess: () => {
                closeMOdal();
                
            }
        });
    }
    else {
        const amount = 20000;

const param2 = "another value";

const encodedAmount = encodeURIComponent(amount);

const url = `/pay?amount=${encodedAmount}&id=${form.id}&date=${form.date}&time_start=${form.time_start}&time_end=${form.time_end}&status=${form.status}&type=${form.type}&payment_status=${form.payment_status}&service_id=${form.service_id}`;

window.location.href = url;
    }

   
};
</script>
<template>
    <div
        ref="addSlotModal"
        tabindex="-1"
        aria-hidden="true"
        class="modal fixed z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative w-full max-w-2xl max-h-full">
            <div
                class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn"
            >
                
                <div
                    class="flex items-start justify-between p-4 border-b rounded-t dark:border-white-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        {{ form.id ? "Edit Appointment" : "Add Appointment" }}
                    </h3>
                    <button
                        @click="closeMOdal"
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal"
                    >
                        <svg
                            class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form @submit.prevent="submit">
                    <div class="p-6 space-y-6">
                        <div class="d-flex mx-5 gap-3 mb-3">
                            <div class="mt-4 w-100">
                                <InputLabel
                                    for="time_start fc-event-title"
                                    value="Date"
                                    style="color: white"
                                />

                                <input
                                    placeholder="Date"
                                    id="date"
                                    type="date"
                                    class="form-control bg-light border-0"
                                    v-model="form.date"
                                    required
                                    autofocus
                                />

                                <InputError
                                    class="mt-2"
                                    :message="errors.date"
                                />
                            </div>
                            <div class="mt-4 w-100">
                                <InputLabel
                                    for="time_start fc-event-title"
                                    value="Time"
                                    style="color: white"
                                />

                                <select
                                    v-model="form.time_start"
                                    class="form-select bg-light border-0"
                                >
                                    <option value="">Select an option</option>
                                    <option
                                        v-for="option in timeOptions"
                                        :key="option.value"
                                        :value="option.value"
                                    >
                                        {{ option.label }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors?.password"
                                />
                            </div>
                        </div>
                        <div class="d-flex mx-5 gap-3 mb-3">
                            <div class="w-100">
                                <InputLabel
                                    for="time_start"
                                    value="Service"
                                    style="color: white"
                                />

                                <select
                                    :disabled="form.id"
                                    v-model="form.service_id"
                                    class="form-select bg-light border-0"
                                >
                                    <option value="">Select an option</option>
                                    <option
                                        v-for="option in service"
                                        :key="option.id"
                                        :value="option.id"
                                    >
                                        {{ option.name }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors?.password"
                                />
                            </div>
                            <div class="w-100">
                                <InputLabel
                                    for="time_start"
                                    value="Type"
                                    style="color: white"
                                />

                                <select
                                    :disabled="form.id"
                                    v-model="form.type"
                                    class="form-select bg-light border-0"
                                >
                                    <option value="">Select an option</option>
                                    <option
                                        v-for="option in options"
                                        :key="option.value"
                                        :value="option.value"
                                    >
                                        {{ option.label }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors?.password"
                                />
                            </div>

                            <!-- <PrimaryButton
                        class="add-button"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="test"
                    >
                        {{ form.id != null? 'Update' : 'Add' }}  
                    </PrimaryButton> -->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                    >
                        <secondary-button
                            @click="closeMOdal"
                            type="button"
                            class="mt-12"
                        >
                            Cancel
                        </secondary-button>
                        <primary-button
                            class="add-button"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            {{ form.id != null ? "Update" : "Add" }}
                        </primary-button>

                        <!-- <button @click="closeMOdal" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
.modal {
    visibility: visible;
    width: 100vw;

    /* display: flex; */
    justify-content: center;
    align-items: center;
}

.modal div {
    animation: show 0.3s ease-in;
}

@keyframes show {
    from {
        transform: scale(0.6);
    }

    to {
        transform: scale(1);
    }
}
</style>
