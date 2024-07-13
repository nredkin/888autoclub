<template>
    <Spinner v-show="this.loading"/>
    <Alert :errors="this.errorMessage"/>
    <div class="sm:px-6 w-full">
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <h3 class="text-4xl font-extrabold dark:text-white">Уровни карт</h3>
            <div class="mt-7 overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-100">
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">Название уровня</p>
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="clubCardLevel of clubCardLevels" :key=clubCardLevel.id tabindex="0"
                        class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ clubCardLevel.name }}</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import {CategoryService} from "../../services/CategoryService";
import {UserService} from "../../services/UserService";
import Spinner from "../forms/Spinner.vue";
import Alert from "../forms/Alert.vue";
import {ClubCardLevelService} from "../../services/ClubCardLevelService";

export default {
    components: {Alert, Spinner},
    data: function () {
        return {
            auth_user:[],
            clubCardLevels: [],
            loading: false,
            errorMessage: false
        }
    },
    name: "ClubCardLevelsList",
    created: function () {
        this.update()
        this.getAuthUser()
    },
    methods: {

        getAuthUser: function () {
            UserService.currentUser()
                .then(response => this.auth_user = response.data.user)
                .catch(error => this.errors = error.data.message)
        },

        update: function () {
            this.loading = true
            ClubCardLevelService.getClubCardLevels()
                .then(response => this.clubCardLevels = response.data.clubCardLevels)
                .catch(error => this.errors = error.data.message)
                .finally(() => this.loading = false)
        },
    }
}
</script>
