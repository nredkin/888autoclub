<template>
    <Spinner v-show="this.loading"/>
    <Alert :errors="this.errorMessage"/>
    <div class="sm:px-6 w-full">
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <h3 class="text-4xl font-extrabold dark:text-white">Пользователи</h3>
            <div class="mt-7 overflow-x-auto">
                <form>
                    <div class="grid md:grid-cols-2 md:gap-6 mt-4 rounded-full p-4 mb-10 border border-gray-100 rounded-0">
                        <div class="relative z-0 w-50 group rounded-full">
                            <TextInput @keyup="update()" v-model:value="query" title="Поиск" type="text" />
                        </div>
                    </div>
                </form>
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-100">
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
<!--                        <td class="">-->
<!--                            <div class="flex items-center pl-5">-->
<!--                                <p class="text-base font-medium leading-none text-gray-700 mr-2">ФИО пользователя</p>-->
<!--                            </div>-->
<!--                        </td>-->
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">Email</p>
                            </div>
                        </td>
                        <td class="pl-24">
                            <div class="flex items-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">Роль</p>
                            </div>
                        </td>
                        <td class="pl-3">
                            <p class="text-sm leading-none text-gray-600 ml-2">Действия</p>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user of users" :key=user.id tabindex="0"
                        class="focus:outline-none h-16 border border-gray-100 rounded">
<!--                        <td class="">-->
<!--                            <div class="flex items-center pl-5">-->
<!--                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ user.name }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ user.email }}</p>
                            </div>
                        </td>
                        <td class="pl-24">
                            <div class="flex items-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.role }}</p>
                            </div>
                        </td>
                        <td class="pl-4">
                            <div class="flex">
                                <router-link :to="{path: '/users/' + user.id}">
                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">
                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                        </svg>
                                    </button>
                                </router-link>

                                <button @click="deleteUser(user.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">
                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="h-3"></tr>
                    </tbody>
                </table>
                <Pagination @click="update(page)" url="users" :current-page="page" :limit="limit" :total="total" />
            </div>
            <router-link to="/users/create"
                         class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"
                         type="button">
                <p class="text-sm font-medium leading-none text-white">Добавить пользователя</p>
            </router-link>
        </div>
    </div>

</template>

<script>
import {UserService} from "../../services/UserService";
import Pagination from "../forms/Pagination.vue";
import TextInput from "../forms/TextInput.vue";
import _ from "lodash"
import Spinner from "../forms/Spinner.vue";
import Alert from "../forms/Alert.vue";

export default {
    components: {Alert, Spinner, TextInput, Pagination},
    data: function () {
        return {
            users: [],
            loading: false,
            errorMessage: null,
            query: '',
            limit: 5,
            total: 1,
            page: Number(this.$route.query.page ?? 1)
        }
    },
    name: "UsersList",
    created:  function () {
        this.update(this.page)
    },
    methods: {
        update:  function () {
            this.loading = true
            UserService.getUsers(this.page, this.query)
                .then(response => {
                this.users = response.data.users
                this.limit = response.data.limit
                this.total = response.data.total
            })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },
        deleteUser: function(id) {
            if (confirm('Вы действительно хотите удалить пользователя?')) {
                UserService.delete(id)
                    .then(() => this.update(this.page))
                    .catch(error => this.errorMessage = error.response.data.error)
            }
        }
    },
    watch: {
        'query': _.debounce(function () {
            this.update()
        }, 500)
    }
}
</script>
