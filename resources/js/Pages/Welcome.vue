<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Appointment from "../Pages/Customer/Index.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    service: {
        type: Object,
        default: null,
    },
});
const showingNavigationDropdown = ref(false);
</script>

<script>
import CustomerLayout from "@/Layouts/CustomerLayout.vue";
export default {
    props: {
        data: Object,
        user: Object,
    },
    components: {
        CustomerLayout,
    },
};
</script>

<template>
    <CustomerLayout>
        <div class="modal fade" id="searchModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div
                    class="modal-content"
                    style="background: rgba(9, 30, 62, 0.7)"
                >
                    <div class="modal-header border-0">
                        <button
                            type="button"
                            class="btn bg-white btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div
                        class="modal-body d-flex align-items-center justify-content-center"
                    >
                        <div class="input-group" style="max-width: 600px">
                            <input
                                type="text"
                                class="form-control bg-transparent border-primary p-3"
                                placeholder="Type search keyword"
                            />
                            <button class="btn btn-primary bg-green px-4">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Full Screen Search End -->

        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div
                id="header-carousel"
                class="carousel slide carousel-fade"
                data-bs-ride="carousel"
            >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img
                            class="w-100"
                            src="/img/carousel-1.jpg"
                            alt="Image"
                        />
                        <div
                            class="carousel-caption d-flex flex-column align-items-center justify-content-center"
                        >
                            <div class="p-3" style="max-width: 900px">
                                <h5
                                    class="text-white text-uppercase mb-3 animated slideInDown"
                                >
                                    Keep Your Teeth Healthy
                                </h5>
                                <h1
                                    class="display-1 text-white mb-md-4 animated zoomIn"
                                >
                                    Take The Best Quality Dental Treatment
                                </h1>
                                <Appointment></Appointment>
                                <a
                                    href=""
                                    class="btn btn-secondary py-md-3 px-md-5 animated slideInRight"
                                    >Contact Us</a
                                >
                            </div>
                        </div>
                    </div>
                    
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#header-carousel"
                    data-bs-slide="prev"
                >
                    <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#header-carousel"
                    data-bs-slide="next"
                >
                    <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container-fluid mb-5">
            <div class="container">
                <div class="row gx-0">
                    <div class="col-lg-6 wow zoomIn" data-wow-delay="0.1s">
                        <div
                            class="bg-green d-flex flex-column p-5"
                            style="height: 300px"
                        >
                            <h3 class="text-white mb-3">Opening Hours</h3>
                            <div
                                class="d-flex justify-content-between text-white mb-3"
                            >
                                <h6 class="text-white mb-0">Mon - Fri</h6>
                                <p class="mb-0">8:00am - 9:00pm</p>
                            </div>
                            <div
                                class="d-flex justify-content-between text-white mb-3"
                            >
                                <h6 class="text-white mb-0">Saturday</h6>
                                <p class="mb-0">8:00am - 7:00pm</p>
                            </div>
                            <div
                                class="d-flex justify-content-between text-white mb-3"
                            >
                                <h6 class="text-white mb-0">Sunday</h6>
                                <p class="mb-0">8:00am - 5:00pm</p>
                            </div>
                            <a class="btn btn-light" href="/dashboard"
                                >Appointment</a
                            >
                        </div>
                    </div>

                    <div class="col-lg-6 wow zoomIn" data-wow-delay="0.6s">
                        <div
                            class="bg-secondary d-flex flex-column p-5"
                            style="height: 300px"
                        >
                            <h3 class="text-white mb-3">Make Appointment</h3>
                            <p class="text-white">
                                Ipsum erat ipsum dolor clita rebum no rebum
                                dolores labore, ipsum magna at eos et eos amet.
                            </p>
                            <h2 class="text-white mb-0">+012 345 6789</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Start -->

        <!-- About Start -->
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-7">
                        <div class="section-title mb-4">
                            <h5
                                class="position-relative d-inline-block text-primary text-uppercase"
                            >
                                About Us
                            </h5>
                            <h1 class="display-5 mb-0">
                                The World's Best Dental Clinic That You Can
                                Trust
                            </h1>
                        </div>
                        <h4 class="text-body fst-italic mb-4">
                            Diam dolor diam ipsum sit. Clita erat ipsum et lorem
                            stet no lorem sit clita duo justo magna dolore
                        </h4>
                        <p class="mb-4">
                            Tempor erat elitr rebum at clita. Diam dolor diam
                            ipsum et tempor sit. Aliqu diam amet diam et eos
                            labore. Clita erat ipsum et lorem et sit, sed stet
                            no labore lorem sit. Sanctus clita duo justo et
                            tempor eirmod magna dolore erat amet
                        </p>
                        <div class="row g-3">
                            <div
                                class="col-sm-6 wow zoomIn"
                                data-wow-delay="0.3s"
                            >
                                <h5 class="mb-3">
                                    <i
                                        class="fa fa-check-circle text-primary me-3"
                                    ></i
                                    >Award Winning
                                </h5>
                                <h5 class="mb-3">
                                    <i
                                        class="fa fa-check-circle text-primary me-3"
                                    ></i
                                    >Professional Staff
                                </h5>
                            </div>
                            <div
                                class="col-sm-6 wow zoomIn"
                                data-wow-delay="0.6s"
                            >
                                <h5 class="mb-3">
                                    <i
                                        class="fa fa-check-circle text-primary me-3"
                                    ></i
                                    >24/7 Opened
                                </h5>
                                <h5 class="mb-3">
                                    <i
                                        class="fa fa-check-circle text-primary me-3"
                                    ></i
                                    >Fair Prices
                                </h5>
                            </div>
                        </div>
                        <a
                            href="/"
                            class="btn btn-primary bg-green py-3 px-5 mt-4 wow zoomIn"
                            data-wow-delay="0.6s"
                            >Make Appointment</a
                        >
                    </div>
                    <div class="col-lg-5" style="min-height: 500px">
                        <div class="position-relative h-100">
                            <img
                                class="position-absolute w-100 h-100 rounded wow zoomIn"
                                data-wow-delay="0.9s"
                                src="img/about.jpg"
                                style="object-fit: cover"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Appointment Start -->
        <div
            class="container-fluid bg-green bg-appointment my-5 wow fadeInUp"
            data-wow-delay="0.1s"
        >
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-6 py-5">
                        <div class="py-5">
                            <h1 class="display-5 text-white mb-4">
                                We Are A Certified and Award Winning Dental
                                Clinic You Can Trust
                            </h1>
                            <p class="text-white mb-0">
                                Eirmod sed tempor lorem ut dolores. Aliquyam sit
                                sadipscing kasd ipsum. Dolor ea et dolore et at
                                sea ea at dolor, justo ipsum duo rebum sea
                                invidunt voluptua. Eos vero eos vero ea et
                                dolore eirmod et. Dolores diam duo invidunt
                                lorem. Elitr ut dolores magna sit. Sea dolore
                                sanctus sed et. Takimata takimata sanctus sed.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointment End -->

        <!-- Service Start -->
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <div class="section-title mb-5">
                            <h5
                                class="position-relative d-inline-block text-primary text-uppercase"
                            >
                                Our Services
                            </h5>
                            <h1 class="display-5 mb-0">
                                We Offer The Best Quality Dental Services
                            </h1>
                        </div>
                       
                        <div class="container mx-auto my-4">
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4"
                            >
                                <!-- First Card -->

                                <div
                                    class="flex flex-col shadow-lg rounded-lg"
                                    v-for="(item, index) in service"
                                    :key="item"
                                >
                                    <div
                                        :id="`carouselExample${index}`"
                                        class="carousel slide"
                                        data-bs-ride="carousel"
                                    >
                                        <div class="carousel-inner">
                                            <div 
                                            
                                                v-for="(
                                                    photo, index
                                                ) in item.photo"
                                                :key="photo"
                                                class="carousel-item"
                                                :class="{ active: index === 0 }"
                                            >
                                                <img  v-if="photo.src"
                                                    :src="photo.src"
                                                    class="w-full h-48 object-cover"
                                                    alt="Placeholder 1"
                                                />
                                                <img  v-else
                                                    src="/img/sevice-1.jpg"
                                                    class="w-full h-48 object-cover"
                                                    alt="Service"
                                                />
                                            </div>
                                        </div>
                                        <button
                                            class="carousel-control-prev"
                                            type="button"
                                            :data-bs-target="`#carouselExample${index}`"
                                            data-bs-slide="prev"
                                        >
                                            <span
                                                class="carousel-control-prev-icon"
                                                aria-hidden="true"
                                            ></span>
                                            <span class="visually-hidden"
                                                >Previous</span
                                            >
                                        </button>
                                        <button
                                            class="carousel-control-next"
                                            type="button"
                                            :data-bs-target="`#carouselExample${index}`"
                                            data-bs-slide="next"
                                        >
                                            <span
                                                class="carousel-control-next-icon"
                                                aria-hidden="true"
                                            ></span>
                                            <span class="visually-hidden"
                                                >Next</span
                                            >
                                        </button>
                                    </div>
                                    <div class="p-4">
                                        <h5 class="text-lg font-bold mb-2">
                                            {{ item.name }}
                                        </h5>
                                        <p class="text-gray-600">
                                            {{ item.description }}
                                        </p>
                                        <div class="d-flex gap-2">
                                            <p
                                                class="text-gray-600 text-bold p-0"
                                            >
                                                <span class="font-bold"
                                                    >PRICE: </span
                                                >{{ item.price }}
                                            </p>
                                            |
                                            <p
                                                class="text-gray-600 text-bold p-0"
                                            >
                                                <span class="font-bold"
                                                    >DURATION: </span
                                                >{{ item.duration }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Second Card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Offer Start -->
        <div
            class="container-fluid bg-offer my-5 py-5 wow fadeInUp"
            data-wow-delay="0.1s"
        >
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7 wow zoomIn" data-wow-delay="0.6s">
                        <div class="offer-text text-center rounded p-5">
                            <h1 class="display-5 text-white">
                                Save 30% On Your First Dental Checkup
                            </h1>
                            <p class="text-white mb-4">
                                Eirmod sed tempor lorem ut dolores sit kasd
                                ipsum. Dolor ea et dolore et at sea ea at dolor
                                justo ipsum duo rebum sea. Eos vero eos vero ea
                                et dolore eirmod diam duo lorem magna sit dolore
                                sed et.
                            </p>
                            <a
                                href="/"
                                class="btn btn-dark py-3 px-5 me-3"
                                >Appointment</a
                            >
                            <a href="" class="btn btn-light py-3 px-5"
                                >Read More</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Offer End -->

        <!-- Pricing Start -->
        <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="section-title mb-4">
                            <h5
                                class="position-relative d-inline-block text-primary text-uppercase"
                            >
                                Pricing Plan
                            </h5>
                            <h1 class="display-5 mb-0">
                                We Offer Fair Prices for Dental Treatment
                            </h1>
                        </div>
                        <p class="mb-4">
                            Tempor erat elitr rebum at clita. Diam dolor diam
                            ipsum et tempor sit. Aliqu diam amet diam et eos
                            labore. Clita erat ipsum et lorem et sit, sed stet
                            no labore lorem sit. Sanctus clita duo justo eirmod
                            magna dolore erat amet
                        </p>
                        <h5
                            class="text-uppercase text-primary wow fadeInUp"
                            data-wow-delay="0.3s"
                        >
                            Call for Appointment
                        </h5>
                        <h1 class="wow fadeInUp" data-wow-delay="0.6s">
                            +012 345 6789
                        </h1>
                    </div>
                    <div class="col-lg-7">
                        <div
                            class="owl-carousel price-carousel wow zoomIn"
                            data-wow-delay="0.9s"
                        >
                            <div class="price-item pb-4">
                                <div class="position-relative">
                                    <img
                                        class="img-fluid rounded-top"
                                        src="img/price-1.jpg"
                                        alt=""
                                    />
                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle"
                                        style="z-index: 2"
                                    >
                                        <h2 class="text-primary m-0">$35</h2>
                                    </div>
                                </div>
                                <div
                                    class="position-relative text-center bg-light border-bottom border-primary py-5 p-4"
                                >
                                    <h4>Teeth Whitening</h4>
                                    <hr
                                        class="text-primary w-50 mx-auto mt-0"
                                    />
                                    <div
                                        class="d-flex justify-content-between mb-3"
                                    >
                                        <span>Modern Equipment</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-3"
                                    >
                                        <span>Professional Dentist</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-2"
                                    >
                                        <span>24/7 Call Support</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <a
                                        href="/"
                                        class="btn btn-primary bg-green py-2 px-4 position-absolute top-100 start-50 translate-middle"
                                        >Appointment</a
                                    >
                                </div>
                            </div>
                            <div class="price-item pb-4">
                                <div class="position-relative">
                                    <img
                                        class="img-fluid rounded-top"
                                        src="img/price-2.jpg"
                                        alt=""
                                    />
                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle"
                                        style="z-index: 2"
                                    >
                                        <h2 class="text-primary m-0">$49</h2>
                                    </div>
                                </div>
                                <div
                                    class="position-relative text-center bg-light border-bottom border-primary py-5 p-4"
                                >
                                    <h4>Dental Implant</h4>
                                    <hr
                                        class="text-primary w-50 mx-auto mt-0"
                                    />
                                    <div
                                        class="d-flex justify-content-between mb-3"
                                    >
                                        <span>Modern Equipment</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-3"
                                    >
                                        <span>Professional Dentist</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-2"
                                    >
                                        <span>24/7 Call Support</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <a
                                        href="/"
                                        class="btn btn-primary bg-green py-2 px-4 position-absolute top-100 start-50 translate-middle"
                                        >Appointment</a
                                    >
                                </div>
                            </div>
                            <div class="price-item pb-4">
                                <div class="position-relative">
                                    <img
                                        class="img-fluid rounded-top"
                                        src="img/price-3.jpg"
                                        alt=""
                                    />
                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light rounded pt-2 px-3 position-absolute top-100 start-50 translate-middle"
                                        style="z-index: 2"
                                    >
                                        <h2 class="text-primary m-0">$99</h2>
                                    </div>
                                </div>
                                <div
                                    class="position-relative text-center bg-light border-bottom border-primary py-5 p-4"
                                >
                                    <h4>Root Canal</h4>
                                    <hr
                                        class="text-primary w-50 mx-auto mt-0"
                                    />
                                    <div
                                        class="d-flex justify-content-between mb-3"
                                    >
                                        <span>Modern Equipment</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-3"
                                    >
                                        <span>Professional Dentist</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between mb-2"
                                    >
                                        <span>24/7 Call Support</span
                                        ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>
                                    </div>
                                    <a
                                        href="/"
                                        class="btn btn-primary bg-green py-2 px-4 position-absolute top-100 start-50 translate-middle"
                                        >Appointment</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pricing End -->

        <!-- Testimonial Start -->
        <div
            class="container-fluid bg-green bg-testimonial py-5 my-5 wow fadeInUp"
            data-wow-delay="0.1s"
        >
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div
                            class="owl-carousel testimonial-carousel rounded p-5 wow zoomIn"
                            data-wow-delay="0.6s"
                        >
                            <div
                                class="testimonial-item text-center text-white"
                            >
                                <img
                                    class="img-fluid mx-auto rounded mb-4"
                                    src="img/testimonial-1.jpg"
                                    alt=""
                                />
                                <p class="fs-5">
                                    Dolores sed duo clita justo dolor et stet
                                    lorem kasd dolore lorem ipsum. At lorem
                                    lorem magna ut et, nonumy labore diam erat.
                                    Erat dolor rebum sit ipsum.
                                </p>
                                <hr class="mx-auto w-25" />
                                <h4 class="text-white mb-0">Client Name</h4>
                            </div>
                            <div
                                class="testimonial-item text-center text-white"
                            >
                                <img
                                    class="img-fluid mx-auto rounded mb-4"
                                    src="img/testimonial-2.jpg"
                                    alt=""
                                />
                                <p class="fs-5">
                                    Dolores sed duo clita justo dolor et stet
                                    lorem kasd dolore lorem ipsum. At lorem
                                    lorem magna ut et, nonumy labore diam erat.
                                    Erat dolor rebum sit ipsum.
                                </p>
                                <hr class="mx-auto w-25" />
                                <h4 class="text-white mb-0">Client Name</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div
            class="container-fluid position-relative pt-5 wow fadeInUp"
            data-wow-delay="0.1s"
            style="z-index: 1"
        >
            <div class="container">
                <div class="bg-green p-5">
                    <form class="mx-auto" style="max-width: 600px">
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control border-white p-3"
                                placeholder="Your Email"
                            />
                            <button class="btn btn-dark px-4">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <a
            href="#"
            class="btn btn-lg btn-primary bg-green btn-lg-square rounded back-to-top"
            ><i class="bi bi-arrow-up"></i
        ></a>
    </CustomerLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
