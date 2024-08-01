<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление статьи расходов</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="store">
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Название статьи расходов" v-model:value="expenseItem.name" type="text"/>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/expenseItems" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена
                    </router-link>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Alert from "../forms/Alert.vue";
import TextInput from "../forms/TextInput.vue";
import Success from "../forms/Success.vue";
import {ExpenseItemService} from "../../services/ExpenseItemService";

export default {
    name: "ExpenseItemCreateForm",
    components: {Alert, TextInput, Success},
    data: function () {
        return {
            loading: false,
            expenseItem: {
                'name': '',
            },
            errors: null,
            message: null
        }
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            ExpenseItemService.store(this.expenseItem)
                .then(response => {
                    this.expenseItem = response.data.expenseItem
                    this.$router.push({name: 'listExpenseItems'})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>

