<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование цвета</h3>

            <Alert :errors="errors"/>
            <Success :message="message"/>

            <form @submit="update">

                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Название цвета" v-model:value="color.name" type="text"/>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/colors" type="button"
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
import {ColorService} from "../../services/ColorService";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import TextInput from "../forms/TextInput.vue";

export default {
    name: "ColorEditForm",
    components: {TextInput, Success, Alert},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            color: {
                'name': '',
            },
            errors: null,
            message: null
        }
    },
    created() {
        this.color = this.getData(this.id)
    },
    methods: {
        closeNotify: function () {
            this.errors = null
        },
        getData: async function (id) {
            ColorService.getById(id)
                .then(response => this.color = response.data.color)
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            ColorService.update(this.color)
                .then(response => {
                    this.color = response.data.color
                    this.message = "Изменения сохранены"
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
