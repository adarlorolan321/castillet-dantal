<script>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import Appointment from "../Customer/Index.vue";
import InputLabel from "@/Components/InputLabel.vue";
export default {
    props: {
        data: Object,
    },
    components: {
        CustomerLayout,
    },
    computed: {},
    data() {},
    watch: {},
    methods: {},
};
</script>
<script setup>
import { computed, onBeforeMount, onMounted, ref } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
import toastr from "toastr";
import "toastr/build/toastr.css";

const data = computed(() => {
    return usePage().props.data;
});

const medicine = computed(() => {
    return usePage().props.medicine;
});
let form = useForm({
    service_id: null,
    description: null,
    date: null,
    title: null,
    xray: [],
    prescription: [],
});

const viewDetails = (data) => {
    // showModal.value = true
    console.log(data);
    showModal.value = true;
    form.id = data.id;

    (form.service_id = data.service.name),
        (form.description = data.description),
        (form.date = data.date),
        (form.title = data.title);
    form.xray = JSON.parse(data.xray);
    form.prescription = JSON.parse(data.prescription);
};
const showModal = ref(false);
</script>
<template>
    <CustomerLayout>
        <div
            class="fixed inset-0 flex items-cente justify-center z-50 bg-opacity-50"
            v-if="showModal"
        >
            <div
                class="bg-white my-auto p-8 r overflow-auto rounded-lg shadow-lg max-w-3xl min-w-3xl scroll-m-9 overflow-y-auto max-h"
                style="max-height: 600px"
            >
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Checkup Details</h2>
                        <button
                            @click="showModal = false"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            <i class="fas fa-times"></i>
                            <!-- Font Awesome close icon -->
                        </button>
                    </div>

                    <table class="table custom-table-width">
                        <tr>
                            <td>Title</td>
                            <td>{{ form.title }}</td>
                        </tr>
                        <tr>
                            <td>Service Name</td>
                            <td>{{ form.service_id }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ form.description }}</td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>{{ form.date }}</td>
                        </tr>

                        <!-- {{form}} -->

                        <!-- You can add more rows here for other details -->
                    </table>
                    <hr />
                    <p>Prescription</p>
                    <div class="card mb-2 p-2" v-for="item in form.prescription">
                        <div class="d-flex">
                            <label
                                for="description"
                                class="block text-gray-600 mt-2"
                            >
                                Medicine:
                            </label>

                            <select
                                disabled
                                v-model="item.medecine_id"
                                class="w-full px-4 py-2 focus:ring focus:ring-blue-200"
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
                        <div class="d-flex">
                            <label  for="quantity" class="block mt-2 text-gray-600">
                                Quantity:
                            </label>
                            <input
                                disabled
                                v-model="item.quantity"
                                type="number"
                                id="quantity"
                                name="quantity"
                                class="w-full px-4 py-2 focus:ring focus:ring-blue-200"
                            />
                        </div>
                        <div class="d-flex">
                            <label
                                for="description"
                                class="block text-gray-600 mt-2"
                            >
                                Description:
                            </label>
                            <textarea
                                disabled
                                row="3"
                                v-model="item.pres_description"
                                type="text"
                                id="description"
                                name="description"
                                class="w-full px-4 py-2 focus:ring focus:ring-blue-200"
                            />
                        </div>
                    </div>
                    <hr />
                    <p>Xray Images</p>
                    <div
                        v-for="item in form.xray"
                        :key="item"
                        class="flex justify-center"
                    >
                        <img
                            width="200"
                            height="200px"
                            class="rounded-lg mr-4 mt-5"
                            :src="item.url"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <div class="section-title mb-5">
                            <h5
                                class="position-relative d-inline-block text-primary text-uppercase"
                            >
                                Youre Dental History
                            </h5>
                            <h1 class="display-5 mb-0">
                                We Offer The Best Quality Dental Services
                            </h1>
                        </div>
                        <div class="flex justify-center p-6">
                            <div
                                class="bg-white shadow-lg rounded-lg p-6 w-100 mx-10"
                            >
                                <div class="container mx-auto">
                                    <ol
                                        class="relative border-l border-gray-200 dark:border-gray-700"
                                    >
                                        <li
                                            class="mb-10 ml-4"
                                            v-for="item in data.data"
                                            :key="item.id"
                                        >
                                            <div
                                                class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                                            ></div>
                                            <time
                                                class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"
                                                >{{ item.date }}</time
                                            >
                                            <h3
                                                class="text-lg font-semibold text-gray-900"
                                            >
                                                {{ item.title }}
                                            </h3>
                                            <p
                                                class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400"
                                            >
                                                {{ item.description }}
                                            </p>

                                            <a
                                                href="#"
                                                @click="viewDetails(item)"
                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                >View
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
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
<style scoped>
.custom-table-width {
    width: 500px; /* Set the desired width here */
}
</style>
