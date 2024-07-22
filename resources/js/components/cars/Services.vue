<template>
  <div class="grid md:grid-cols-2 md:gap-6">
      <div>
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Услуги</h3>
          <table class="table border">
              <thead>
              <tr>
                  <td>Наименование услуги</td>
                  <td>Базовый</td>
                  <td v-for="clubCardLevel in clubCardLevels">{{ clubCardLevel.name }}</td>
<!--                  <td>Действия</td>-->
              </tr>
              </thead>
              <tbody v-if="services.length > 0">
              <tr v-for="service in services" :key="service.service.id" >
                  <td>{{ service.service.name }}</td>
                  <td>{{ getPrice(service.service.id, null) }}</td>
                  <td v-for="clubCardLevel in clubCardLevels">{{ getPrice(service.service.id, clubCardLevel.id) }}</td>
<!--                  <td>-->
<!--                      <button @click="deleteService(service.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none rounded hover:bg-red-200 focus:outline-none">-->
<!--                          <svg fill="none" height="20" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
<!--                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>-->
<!--                          </svg>-->
<!--                      </button>-->
<!--                  </td>-->
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
<!--              <button @click="showModal"-->
<!--                      class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"-->
<!--                      type="button">-->
<!--                  Добавить услугу-->
<!--              </button>-->

              <!-- Main modal -->
              <div v-show="!isHidden" tabindex="-1"
                   class="fixed flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
                              <form class="space-y-6" @submit="storeService" action="#">
                                  <div>
                                      <div class="relative z-1 w-full mb-6 group">
<!--                                          <my-select name="clubCardLevelId" v-model:value="newCard.club_card_level_id" title="Уровень" :values="clubCardLevels"/>-->
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
import {ServicePriceService} from "../../services/ServicePriceService";
import {ClubCardLevelService} from "../../services/ClubCardLevelService";


export default {
  name: 'Services',
    components: {MySelect, NumberInput},
    props: {
        carId: {
            type: Number,
            required: true
        }
    },
    data: function () {
        return {
            isHidden: true,
            errors: null,
            services: [],
            clubCardLevels: [],
        }
    },
    watch: {
        carId: {
            immediate: true,
            handler(newCarId) {
                if (newCarId) {
                    this.loadServices().then(response => console.log(this.services));
                    ClubCardLevelService.getClubCardLevels().then(response => {this.clubCardLevels = response.data.clubCardLevels})

                }
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
        loadServices: async function () {
            await ServicePriceService.getServicePricesByCar(this.carId).then( response => this.services = response.data.services)
        },
        getPrice(service_id, club_card_level_id) {
            // Flatten the array of services and their prices into a single array of servicePrices
            const servicePrices = this.services.flatMap(service => service.servicePrices);
            // Find the price entry that matches the provided service_id and club_card_level_id
            const priceEntry = servicePrices.find(sp => sp.service_id === service_id && sp.club_card_level_id === club_card_level_id);
            // Return the price if found, otherwise null
            return priceEntry ? priceEntry.price : null;
        }

    }
}
</script>
