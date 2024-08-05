<template>
  <div class="grid md:grid-cols-3 md:gap-6">
      <div>
          <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Финансовая информация</h3>
          <h2 class="mb-2 text-2xl font-medium">Баланс: {{ client.balance }} руб</h2>
          <h2 class="mb-2 text-2xl font-medium">Бонусные баллы: {{ client.bonus_points }} </h2>
          <table class="table border">
              <thead>
              <tr>
                  <td>ID</td>
                  <td>Сумма</td>
                  <td>Действия</td>
              </tr>
              </thead>
              <tbody v-if="operations.length > 0">
              <tr v-for="operation in operations">
                  <td>{{ operation.id }}</td>
                  <td>{{ operation.sum }}</td>
                  <td>
                      <button @click="deleteOperation(operation.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none rounded hover:bg-red-200 focus:outline-none">
                          <svg fill="none" height="20" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                          </svg>
                      </button>
                  </td>
              </tr>
              </tbody>
              <tbody v-else>
              <tr>
                  <td colspan="4">Операций пока нет</td>
              </tr>
              </tbody>
          </table>
          <div class="mt-6 flex items-center justify-end gap-x-6">
              <!-- Modal toggle -->
              <button @click="showModal"
                      class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                      type="button">
                  Добавить операцию
              </button>

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
                                  Добавление операции</h3>
                              <form class="space-y-6" @submit="storeOperation" action="#">
                                  <div>
                                      <NumberInput title="Сумма" v-model:value="newOperation.sum"
                                                   min="0" step="0.01"/>
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
import {OperationService} from "../../services/OperationService";
import MySelect from "../forms/MySelect.vue";
import NumberInput from "../forms/NumberInput.vue";
import {UserService} from "../../services/UserService";


export default {
  name: 'Balance',
    components: {MySelect, NumberInput},
    props: {
        userId: null,
    },
    data: function () {
        return {
            isHidden: true,
            errors: null,
            operations: [],
            newOperation: {
                user_id: this.userId,
                car_id: null,
                deal_id: null,
                sum: 0,
                type: 0,
                client_balance_change: 1,
            },
            user: {},
            client: {
                balance: 0,
                bonus_points: 0,
            },
        }
    },
    created: async function () {
        this.loadUser();
        this.loadOperations();
    },
    methods: {
        showModal: function () {
            this.isHidden = false
        },
        closeModal: function () {
            this.isHidden = true
        },
        loadOperations: function () {
            OperationService.getOperationsByModelId('user', this.userId).then( response => this.operations = response.data.operations)
        },
        storeOperation: function (event) {
            event.preventDefault()
            this.errors = null;
            OperationService.store(this.newOperation)
                .then(response => {
                    this.operations.push(response.data.operation)
                    this.isHidden = true
                    this.loadOperations()
                    this.loadUser()
                })
                .catch(error => this.errors = error)
        },
        deleteOperation: function(id) {
            if (confirm('Вы действительно хотите удалить операцию?')) {
                OperationService.delete(id)
                    .then(response => this.loadOperations())
                    .catch(error => this.errors = error.response.data.error)
            }
        },
        loadUser: function (){
            UserService.getById(this.userId)
                .then(response => {
                    this.user = response.data.user
                    this.client = this.user.userable
                    this.newOperation.user_id = this.user.id
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
