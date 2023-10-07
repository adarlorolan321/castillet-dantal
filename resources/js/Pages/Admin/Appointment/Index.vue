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



const routeName = "appointment";

const formObject = {




};

const handleApprove = (id) =>{
    form.patch(route('apointment.approve',{id:id}),{
        onSuccess: () => {
            resetInput();
        }
    });
}


let {
  isLoadingComponents,
  paginatedData,
  form,
  createPromise,
  updatePromise,
  deletePromise,
  handleCreate,
  serverQuery,
  handleServerQuery,
  handleEdit,
  formState,
} = useCrud(formObject, routeName);
</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto ">
          
            <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
                <div class="card-body p-2">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2">
                        <div class="w-auto">Show</div>
                        <div class="flex-1">
                            <select
                                class="form-select"
                                :value="serverQuery.perPage"
                                @input="
                                    handleServerQuery(
                                        'perPage',
                                        $event.target.value
                                    )
                                "
                            >
                                <option
                                    v-for="i in [5, 10, 25, 50, 100]"
                                    :value="String(i)"
                                    :key="i"
                                >
                                    {{ i }}
                                </option>
                            </select>
                        </div>
                        <div class="w-auto">entries</div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex gap-2 align-items-center">
                        <div class="w-auto">Search:</div>
                        <div class="flex-1">
                            <input
                                type="search"
                                placeholder="Search"
                                class="form-control"
                                :value="serverQuery.query"
                                @input="
                                    handleServerQuery(
                                        'query',
                                        $event.target.value
                                    )
                                "
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Patient Name
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                               Date
                            </th>
                            
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Time
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Status
                            </th>
                            <th
                                scope="col"
                                class="px-5 py-3 bg-green-template text-white font-semibold uppercase tracking-wider"
                            >
                                Action
                            </th>
                            <!-- Add more table headers if needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Replace the example data with your dynamic data -->
                        <tr v-for="data in paginatedData.data" :key="data">
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.user.name }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.date }}
                            </td>
                           
                            
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.time_start }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                {{ data.status }}
                            </td>
                            <td
                                class="px-5 py-3 border-b border-gray-200 bg-white text-sm"
                            >
                                <a
                                    href="javascript:void(0)"
                                    class="text-blue-500 mr-2"
                                    @click="handleApprove(data.id)"
                                    ><i
                                            class="fa fa-check text-primary pt-1"
                                        ></i>Approve</a
                                >
                                
                                
                            </td>
                            <!-- Add more table data rows if needed -->
                        </tr>
                    </tbody>
                   
                </table>
                
            </div>
            <div
      class="card-footer py-3 w-100"
      v-if="paginatedData && paginatedData.meta.links"
    >
      <div class="row justify-content-between">
        <div class="col-auto">
          <div class="table_info">
            Showing {{ paginatedData.meta.from }} to
            {{ paginatedData.meta.to }} of
            {{ paginatedData.meta.total }} entries
          </div>
        </div>
        <div class="col-auto">
          <nav
            class="dataTables_paginate paging_simple_numbers"
            aria-label="Page navigation example"
          >
            <ul class="pagination mb-0">
              <li
                class="page-item"
                v-for="link in paginatedData.meta.links"
                :key="link"
              >
                <a
                  :is="link.url ? 'inertia-link' : 'button'"
                  class="page-link"
                  :class="{
                    active: link.active,
                  }"
                  :href="link.url"
                  :only="['data', 'params']"
                >
                  <span v-html="link.label"></span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
            <!-- Modal to add details -->

            <!-- Rest of your content -->
        </div>
    </AuthenticatedLayout>
</template>
