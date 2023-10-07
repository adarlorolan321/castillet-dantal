<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useCrud } from "@/Composables/Crud.js";
import { computed, ref } from "vue";
import axios from "axios";
import Dropzone from "../../../Components/Dropzone.vue";

const services = computed(() => usePage().props.services);
const user = computed(() => usePage().props.user);
const history = computed(() => usePage().props.history);
const medicine = computed(() => usePage().props.medicine);
let form = useForm({
    user_id: user.value.id,
    service_id: null,
    description: null,
    date: null,
    title: null,
    xray: [],
    prescription: [
        {
            medecine_id: null,
            quantity: null,
            description: null,
        },
    ],
});

const showModal = ref(false);

const editServices = (data) => {
    console.log(data);
    showModal.value = true;
    form.id = data.id;
    (form.user_id = user.value.id),
        (form.service_id = data.service_id),
        (form.description = data.description),
        (form.date = data.date),
        (form.title = data.title),
        (form.xray = JSON.parse(data.xray));
        (form.prescription = JSON.parse(data.prescription));
};

const addPrescription = () => {
    form.prescription.push({
        medecine_id: null,
        quantity: null,
        pres_description: null,
    })
}

const removePrescription = (index) => {
    form.prescription.splice(index, 1);
}
const resetInput = () => {
    showModal.value = false;

    form.service_id = null;
    form.description = null;
    form.duration = null;
    form.price = null;
    form.photo = [];
    form.prescription = [
        {
            medecine_id: null,
            quantity: null,
            pres_description: null,
        },
    ];

    xray = [];

    form.id = null;
};

const closeModal = () => {
    resetInput();
    showModal.value = false;
};

const submitForm = async () => {
    console.log(form);
    if (form.id) {
        console.log(form);
        await form.patch(route("user-history.update", form.id), {
            onSuccess: () => {
                resetInput();
            },
        });
    } else {
        await form.post(route("user-history.store"), {
            onSuccess: () => {
                resetInput();
            },
        });
    }
};
const deleteServices = (id) => {
    form.delete(route("dental-services.destroy", id));
};
</script>

<template>
    <AuthenticatedLayout>
        <div
            class="fixed inset-0 flex items-center justify-center z-50 bg-opacity-50"
            v-if="showModal"
        >
            <div
                class="bg-white p-8 rounded-lg shadow-lg max-w-xl min-w-xl scroll-m-9 overflow-y-auto max-h"
            >
                <div class="">
                    <h2
                        class="text-2xl font-bold mb-4"
                        @click="showModal = true"
                    >
                        Add Details
                    </h2>
                    <form>
                        <div class="row">
                            <div class="mb-4">
                                <InputLabel for="time_start" value="Type" />

                                <select
                                    v-model="form.service_id"
                                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                >
                                    <option value="">Select an option</option>
                                    <option
                                        v-for="option in services"
                                        :key="option.id"
                                        :value="option.id"
                                    >
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label
                                    for="description"
                                    class="block text-gray-600 mb-2"
                                >
                                    Action Taken
                                </label>
                                <input
                                    v-model="form.title"
                                    type="text"
                                    id="description"
                                    name="description"
                                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="description"
                                    class="block text-gray-600 mb-2"
                                >
                                    Description
                                </label>
                                <textarea
                                    row="3"
                                    v-model="form.description"
                                    type="text"
                                    id="description"
                                    name="description"
                                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="time_end"
                                    class="block text-gray-600 mb-2"
                                >
                                    Date
                                </label>
                                <input
                                    v-model="form.date"
                                    type="date"
                                    id="duration"
                                    name="duration"
                                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                />
                            </div>

                            <h2
                                class="text-2xl font-bold mb-4"
                                @click="showModal = true"
                            >
                                Prescription
                            </h2>
                            <!-- <pre>{{ form.prescription }}</pre> -->
                            <div class="card mb-2" v-for="item in form.prescription">
                                <div class="text-right">
                                    <button
                                    @click="removePrescription(item.id)"
                                        class=""
                                    >
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                
                                <div class="mb-4">
                                <InputLabel for="time_start" value="Type" />

                                <select
                                    v-model="item.medecine_id"
                                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                >
                                    <option value="">Select an option</option>
                                    <option
                                        v-for="option in medicine"
                                        :key="option.id"
                                        :value="option.id"
                                    >
                                        {{ option.name }}
                                    </option>
                                </select>
                            </div>
                                <div class="mb-4">
                                    <label
                                        for="quantity"
                                        class="block text-gray-600 mb-2"
                                    >
                                        Quantity
                                    </label>
                                    <input
                                        v-model="item.quantity"
                                        type="number"
                                        id="quantity"
                                        name="quantity"
                                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                    />
                                </div>
                                <div class="mb-4">
                                    <label
                                        for="description"
                                        class="block text-gray-600 mb-2"
                                    >
                                        Description
                                    </label>
                                    <textarea
                                        row="3"
                                        v-model="item.pres_description"
                                        type="text"
                                        id="description"
                                        name="description"
                                        class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                                    />
                                </div>
                                
                            </div>
                            <div class="text-right">
                                    <button
                                    @click="addPrescription"
                                        class="bg-green-template text-white px-4 py-2 rounded"
                                    >
                                        Add Prescription
                                    </button>
                                </div>
                            <label
                                for="time_end"
                                class="block text-gray-600 mb-2"
                            >
                                Xray Images
                            </label>
                            <Dropzone
                                class="bg-white p-8 rounded-lg shadow-sm mb-2"
                                collection="xray"
                                :url="route('api.media.upload')"
                                :value="form.xray"
                                @input="
                                    ($event) => {
                                        form.xray = $event;
                                        form.clearErrors('xray');
                                    }
                                "
                                @error="
                                    ($event) => {
                                        if ($event && $event[0]) {
                                            form.setError('xray', $event[0]);
                                        }
                                    }
                                "
                                model="CheckupHistory"
                                message="Drop Xray here or click to upload profile photo"
                                acceptedFiles="image/jpeg,image/png"
                            ></Dropzone>
                        </div>

                        <div class="text-right">
                            <button
                                type="button"
                                class="text-gray-600 px-4 py-2 mr-2"
                                @click="closeModal"
                            >
                                Cancel
                            </button>
                            <button
                                @click="submitForm"
                               
                                class="bg-green-template text-white px-4 py-2 rounded"
                            >
                                {{ form.id ? "Update" : "Add" }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      
        <div class="flex justify-center p-6">
            <div class="bg-white shadow-lg rounded-lg p-6 w-100 mx-10">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold mb-4">Checkup History</h2>
                    <PrimaryButton
                        @click="showModal = true"
                        class="add-button p-0 m-0"
                    >
                        {{ "Add" }}
                    </PrimaryButton>
                </div>
                <div class="container mx-auto">
                    <ol
                        class="relative border-l border-gray-200 dark:border-gray-700"
                    >
                        <li
                            class="mb-10 ml-4"
                            v-for="item in history"
                            :key="item.id"
                        >
                            <div
                                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                            ></div>
                            <time
                                class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"
                                >{{ item.date }}</time
                            >
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ item.title }}
                            </h3>
                            <p
                                class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400"
                            >
                                {{ item.description }}
                            </p>
                           
                            <a
                                href="#"
                                @click="editServices(item)"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                >Edit
                                <svg
                                    class="w-3 h-3 ml-2"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 14 10"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                    /></svg
                            ></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
.max-h {
    max-height: 600px !important;
}
</style>
