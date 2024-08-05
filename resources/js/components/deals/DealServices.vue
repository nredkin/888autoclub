<template>
  <div class="grid md:grid-cols-3 md:gap-6">
      <div>
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Список услуг</h3>
          <table class="table border">
              <thead>
              <tr>
                  <td>Услуга</td>
                  <td>Стоимость</td>
                  <td>Действия</td>
              </tr>
              </thead>
              <tbody v-if="services.length > 0">
              <tr v-for="service in services">
                  <td>{{ service.name }}</td>
                  <td>{{ service.price_total }}</td>
                  <td>
                      <button @click="removeService(service.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none rounded hover:bg-red-200 focus:outline-none">
                          <svg fill="none" height="20" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                          </svg>
                      </button>
                  </td>
              </tr>
              </tbody>
              <tbody v-else>
              <tr>
                  <td colspan="4">Услуг пока нет</td>
              </tr>
              </tbody>
          </table>
          <div class="mt-6 flex items-center justify-end gap-x-6">
              <!-- Modal toggle -->
              <button @click="showModal"
                      class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                      type="button">
                  Добавить услугу
              </button>

              <!-- Main modal -->
              <div v-show="!isHidden" tabindex="-1"
                   class="fixed flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                  <div class="relative w-full max-w-md max-h-full">
                      <!-- Modal content -->
                      <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                          <button @click="closeModal" type="button"
                                  class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                   viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                              </svg>
                              <span class="sr-only">Close modal</span>
                          </button>
                          <div class="px-6 py-6 lg:px-8">
                              <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
                                  Добавление услуги</h3>
                              <form class="space-y-6" @submit="addService" action="#">
                                  <div>
                                      <div class="relative w-full mb-6 group">
                                          <my-select name="serviceId" v-model:value="newService.id" title="Услуга" :values="availableServices"/>
                                      </div>
                                      <!-- Checkbox for Custom Price -->
                                      <div class="relative w-full mb-6 group">
                                          <Checkbox
                                              title="Установить стоимость вручную"
                                              v-model:checked="enableCustomPrice"
                                              :checked="enableCustomPrice"
                                          />
                                          <NumberInput v-model:value="newService.price" :disabled="!enableCustomPrice" placeholder="Стоимость"
                                                 step="0.01"/>
                                      </div>

                                      <!-- Checkbox for Custom Rental Dates -->
                                      <div class="relative w-full mb-6 group">
                                              <Checkbox
                                                  title="Установить даты аренды вручную"
                                                  v-model:checked="enableCustomDate"
                                                  :checked="enableCustomDate"
                                              />
                                          <div class="">
                                              <DateInput name="rental_start" v-model:value="newService.rental_start" :disabled="!enableCustomDate"
                                                     title="Дата начала" type="datetime-local"/>
                                              <DateInput name="rental_утв" v-model:value="newService.rental_end" :disabled="!enableCustomDate"
                                                     title="Дата завершения" type="datetime-local"/>
                                          </div>
                                      </div>
                                  </div>

                                  <button type="submit"
                                          class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                      Сохранить
                                  </button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
</template>
<script>
import MySelect from "../forms/MySelect.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import Checkbox from "../forms/Checkbox.vue";
import {ServiceService} from "../../services/ServiceService";
import {DealService} from "../../services/DealService";

export default {
  name: 'DealServices',
    components: {MySelect, NumberInput, DateInput, Checkbox},
    props: {
        deal: Object,
    },
    data: function () {
        return {
            isHidden: true,
            errors: null,
            services: [],
            availableServices: [],
            newService: {
                id: null,
                price: null,
                rental_start: null,
                rental_end: null,
            },
            enableCustomPrice: false,
            enableCustomDate: false,
        }
    },
    created() {
        this.loadAvailableServices();
    },
    watch: {
        deal() {
          this.loadDealServices();
        },
        enableCustomPrice(val) {
            if (!val) this.newService.price = null;
        },
        enableCustomDate(val) {
            if (!val) {
                this.newService.rental_start = null;
                this.newService.rental_end = null;
            }
        }
    },
    methods: {
        showModal: function () {
            this.isHidden = false
        },
        closeModal: function () {
            this.isHidden = true
        },
        loadAvailableServices: function () {
            ServiceService.getServices()
                .then( response => {
                    this.availableServices = response.data.services;
                })
        },
        loadDealServices: function () {
           ServiceService.getServicesByDealId(this.deal.id)
               .then( response => {
                   this.services = response.data.services;
               })
        },
        addService: function(event) {
            event.preventDefault()
            DealService.attachServiceToDeal(this.deal.id, this.newService).then(() => {
                this.loadDealServices();
                this.closeModal();
                this.newService = { id: null, price: null, rental_start: null, rental_end: null };
                this.enableCustomPrice = false;
                this.enableCustomDate = false;
            })
                .catch(error => this.errors = error);
        },
        removeService: function(serviceId) {
            DealService.detachServiceFromDeal(this.deal.id, serviceId).then(() => {
                this.loadDealServices();
            })
                .catch(error => this.errors = error);
        },
    }
}
</script>
