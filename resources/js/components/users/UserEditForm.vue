<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование пользователя</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="update">
                <div class="relative z-0 w-full mb-6 group">
                    <Checkbox title="Пользователь активен?" name="enabled" v-model:checked="user.is_active"
                              :checked="user.is_active"/>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-1 w-full mb-6 group">
                        <my-select v-model:value="user.roleId" title="Роль" :values="userRoles"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Email" v-model:value="user.email" type="email"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Пароль" v-model:value="user.password" type="password"/>
                    </div>
                </div>

                <EmployeeFields v-if="user.roleId == 1 || user.roleId == 2" :userable="user.userable" />
                <ClientFields v-if="user.roleId == 3" :userable="user.userable" :userId="user.id" />

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/users" type="button"
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
import {UserService} from "../../services/UserService";
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Checkbox from "../forms/Checkbox.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import MySelect from "../forms/MySelect.vue";
import EmployeeFields from "./EmployeeFields.vue";
import ClientFields from "./ClientFields.vue";

export default {
    name: "UserEditForm",
    components: {MySelect, Textarea, DateInput, Alert, TextInput, Success, Checkbox, EmployeeFields, ClientFields},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            userRoles: [],
            user: {
                'email': '',
                'is_active': '',
                'password': null,
                'roleId': null,
                userable: {
                    'lastName': '',
                    'firstName': '',
                    'middleName': '',
                    'branchId': 0,
                    'categoryIds': [],
                    'type': 0,
                    // Add other fields if needed
                }
            },
            errors: null,
            submitted: false,
            message: null
        }
    },
    async created() {
        await UserService.getRoles()
            .then(response => this.userRoles = response.data.roles)
        await UserService.getById(this.id)
            .then(response => this.user = response.data.user)
            .catch(error => {
                this.errors = error.response.data.message
            })
    },
    methods: {
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            UserService.update(this.user)
                .then(response => {
                    this.user = response.data.user
                    this.message = 'Изменения сохранены'
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
