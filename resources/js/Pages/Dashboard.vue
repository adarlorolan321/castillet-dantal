<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { useRoute } from "vue-router";

const service = usePage().props.service
const apointment = usePage().props.appointments
const user = usePage().props.user
const totalAmount = usePage().props.totalAmount

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="d-flex gap-4 flex-1 mt-5 px-5">
            <!-- Total Number of Patients Card -->
            <div class="card w-full p-3 patient">
                <div class="card-title flex justify-between ">Total Patient <i class="fas fa-user"></i></div>
                <div class="card-body text-center">
                    <h2>{{ user.length  }}</h2>
                </div>
            </div>

            <!-- Total Appointments Card -->
            <div class="card w-full p-3 appointment">
                <div class="card-title flex justify-between ">Total Appointments <i class="fas fa-calendar"></i></div>
                
                <div class="card-body text-center">
                    <h2>{{ apointment.length  }}</h2>
                </div>
            </div>
            <div class="card w-full p-3 revenue">
                <div class="card-title flex justify-between">Total Revenue <i class="fas fa-dollar-sign"></i></div>

                <div class="card-body text-center">
                    <h2>₱{{ totalAmount }}</h2>
                </div>
            </div>

            <!-- Total Revenue Card -->
            <div class="card w-full p-3 service">
                <div class="card-title flex justify-between">Total Service <i class="fas fa-bell"></i></div>

                <div class="card-body text-center">
                    <h2>{{ service.length }}</h2>
                </div>
            </div>

            <!-- Total Services Card -->
           
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.patient{
    background-color: #a9aaad;
}
.appointment{
    background-color: #04bade;
}
.revenue{
    background-color: #26b170;
}
.service{
    background-color: #f26553;
}

</style>
