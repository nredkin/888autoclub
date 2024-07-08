<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование филиала</h3>

            <Alert :errors="errors"/>
            <Success :message="message"/>

            <form @submit="update">

                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Название филиала" v-model:value="branch.name" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Адрес филиала" v-model:value="branch.address" type="text"/>
                </div>
                <div v-show="auth_userId === 1" class="relative z-0 w-full mb-6 group">
                    <TextInput title="Ключ для интеграции" v-model:value="branch.wa_token" type="text"/>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/branches" type="button"
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
import {BranchService} from "../../services/BranchService";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import TextInput from "../forms/TextInput.vue";

export default {
    name: "BranchEditForm",
    components: {TextInput, Success, Alert},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            branch: {
                'name': '',
                'address': '',
                'wa_token': ''
            },
            auth_userId: Number(this.$route.query.auth_userId),
            errors: null,
            message: null
        }
    },
    created() {
        this.branch = this.getData(this.id)
    },
    methods: {
        closeNotify: function () {
            this.errors = null
        },
        getData: async function (id) {
            BranchService.getById(id)
                .then(response => this.branch = response.data.branch)
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            BranchService.update(this.branch)
                .then(response => {
                    this.branch = response.data.branch
                    this.message = "Изменения сохранены"
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
