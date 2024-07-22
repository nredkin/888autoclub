<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление пользователя</h3>
            <Alert :errors="errors" />
            <Success :message="message" />
            <form @submit="store">
                <div class="relative z-0 w-full mb-6 group">
                    <Checkbox title="Пользователь активен?" name="enabled" v-model:checked="user.is_active"
                              :checked="user.is_active"/>
                </div>
                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-1 w-full mb-6 group">
                        <my-select name="roleId" v-model:value="user.roleId" title="Роль" :values="userRoles"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Email" v-model:value="user.email" type="email"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Пароль" v-model:value="user.password" type="password"/>
                    </div>
                </div>
                <EmployeeFields v-if="user.roleId == 1 || user.roleId == 2" :userable="user.userable" />
                <ClientFields v-if="user.roleId == 3" :userable="user.userable" />

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
import Select from "../forms/Select.vue";
import Success from "../forms/Success.vue";
import Checkbox from "../forms/Checkbox.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import MySelect from "../forms/MySelect.vue";
import EmployeeFields from "./EmployeeFields.vue";
import ClientFields from "./ClientFields.vue";

export default {
    name: "UserCreateForm",
    components: {MySelect, DateInput, Checkbox, Select, Alert, TextInput, Success, Textarea, EmployeeFields, ClientFields},
    data: function () {
        return {
            loading: false,
            userRoles: [],
            user: {
                'email': '',
                'is_active': 1,
                'password': null,
                'roleId': 0,
                userable: {
                    lastName: '',
                    firstName: '',
                    middleName: '',
                    branchId: 0,
                    categoryIds: []
                    // Add other fields if needed
                }
            },
            errors: null,
            message: null
        }
    },
    created: async function () {
        UserService.getRoles().then(response => this.userRoles = response.data.roles)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            UserService.store(this.user)
                .then(response => {
                    this.user = response.data.user
                    this.$router.push({name: 'listUsers'})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
            return true;
        },
    },
}
</script>
