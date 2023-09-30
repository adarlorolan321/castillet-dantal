<script>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
import Appointment from "../Customer/Index.vue";

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
import { usePage,router  } from "@inertiajs/vue3";
import toastr from "toastr";
import 'toastr/build/toastr.css';
import Swal from "sweetalert2";

const data = computed(() => {
    return usePage().props.appointment;
});

const deleteAppointment = async (id) => {
        Swal.fire({
            icon: "warning",
            title: "Are you sure you want to cancel your appoinment?",
            text: "Ther is no refund after canceling",
          
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel it!",
            customClass: {
                confirmButton: "btn btn-primary me-3",
                cancelButton: "btn btn-label-danger",
            },
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                router.delete(route(`customer-appointments.destroy`, id), {
                    preserveState: true,
                    preventScroll: true,
                    only: ["data", "params"],
                    onSuccess: () => {

                        toastr.error("Record deleted");
                        window.location.reload();
                    },
                });
            }
        });
    };


</script>
<template>
    <CustomerLayout>
        <div class="container-fluid py-5" >
            <div class="container">
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <div class="section-title mb-5">
                            <h5
                                class="position-relative d-inline-block text-primary text-uppercase"
                            >
                            Your Upcoming Appointment
                            </h5>
                            <h1 class="display-5 mb-0">
                                Discover Premium Dental Services Tailored Just for You
                            </h1>
                        </div>
                        <div class="flex justify-center " v-if="data">
                            <div
                                class="bg-white shadow-lg rounded-lg p-6 w-100 mx-10"
                            >
                            <div class="d-flex justify-between">
                                <h2 class="text-xl font-semibold mb-4 ">
                                    Appointment Details
                                </h2>
                                <a :href="route('reciept', data.id)">Request a Reciept</a>

                            </div>
                                

                                <p><strong>Date:</strong> {{ data.date }}</p>
                                <p>
                                    <strong>Time Start:</strong>
                                    {{ data.time_start }}
                                </p>
                                <p>
                                    <strong>Time End:</strong>
                                    {{ data.time_end }}
                                </p>

                                <hr />
                                <p>
                                    <strong>Payment Amount:</strong> ₱{{
                                        parseFloat(data.payment_amount).toFixed(
                                            2
                                        )
                                    }}
                                </p>
                                <p>
                                    <strong>Payment Method:</strong>
                                    {{ data.payment_method }}
                                </p>
                                <p>
                                    <strong>Payment Status:</strong>
                                    {{ data.payment_status }}
                                </p>

                                <hr />
                                <p>
                                    <strong>Service Name:</strong>
                                    {{ data.service.name }}
                                </p>
                                <p>
                                    <strong>Service Duration:</strong>
                                    {{ data.service.duration }}
                                </p>

                                <p>
                                    <strong>Status:</strong> {{ data.status }}
                                </p>
                                <p><strong>Type:</strong> {{ data.type }}</p>
                                <div class="flex justify-end gap-2"><primary-button @click="deleteAppointment(data.id)">Cancel Appointment</primary-button><Appointment
                                    label = Reschedule
                                    :data = data
                                    /></div>
                            </div>

                           
                        </div>
                        <div class="flex justify-center " v-else>
                            <div
                                class="bg-white shadow-lg rounded-lg p-6 w-100 mx-10"
                            >
                                <h2 class="text-xl text-center font-semibold mb-4">
                                   No Appointment, Add one
                                </h2>
                                <hr>
                                <div class="text-center">
                                    <Appointment></Appointment>

                                </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>
