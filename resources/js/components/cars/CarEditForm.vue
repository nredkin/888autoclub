<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование автомобиля</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="update">
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Модель" v-model:value="car.model" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Номер кузова (VIN)" v-model:value="car.vin" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Год выпуска" v-model:value="car.year" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Модель двигателя" v-model:value="car.engine_model" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Мощность двигателя" v-model:value="car.engine_power" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <my-select title="Цвет" v-model:value="car.color_id" :values="colors"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Стоимость" v-model:value="car.cost" type="number"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <my-select name="branchId" v-model:value="car.branch_id" title="Филиал" :values="branches"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Серия свидетельства о регистрации" v-model:value="car.registration_series" type="number"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title=" Номер свидетельства о регистрации" v-model:value="car.registration_number" type="number"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="ПТС номер" v-model:value="car.pts_number" type="number"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <DateInput title=" ПТС дата выдачи" v-model:value="car.pts_date"
                               type="date"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Регистрационный знак" v-model:value="car.reg_sign" type="number"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Textarea title="Описание" name="description" v-model:value="car.description"/>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/cars" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена
                    </router-link>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>
                </div>

                <Services :carId="id" />

                <div class="w-full mb-6 group">
                    <Operations :carId="id"/>
                </div>

                <div class="w-full mb-6 group">
                    <Files :modelId="id" modelType="car"/>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Alert from "../forms/Alert.vue";
import TextInput from "../forms/TextInput.vue";
import Success from "../forms/Success.vue";
import {CarService} from "../../services/CarService";
import DateInput from "../forms/DateInput.vue";
import MySelect from "../forms/MySelect.vue";
import {BranchService} from "../../services/BranchService";
import {ColorService} from "../../services/ColorService";
import Textarea from "../forms/Textarea.vue";
import Services from "./Services.vue"
import Files from "../common/Files.vue"
import Operations from "./Operations.vue";

export default {
    name: "CarEditForm",
    components: {Operations, Services, Files, Textarea, MySelect, DateInput, Alert, TextInput, Success},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            car: {
                'id': null,
                'model': '',
                'vin': '',
                'year':  '',
                'engine_model':  '',
                'engine_power':  '',
                'color_id':  '',
                'cost' :    '',
                'branch_id' :  '',
                'registration_series': '',
                'registration_number': '',
                'pts_number' : '',
                'pts_date': '',
                'reg_sign' : '',
                'description': '',
            },
            branches: [],
            colors: [],
            errors: null,
            message: null
        }
    },
    created: async function () {
        BranchService.getBranches().then(response => this.branches = response.data.branches)
        ColorService.getColors().then(response => this.colors = response.data.colors)
        await this.getData(this.id)

    },
    methods: {
        getData: async function (id) {
            CarService.getById(id)
                .then(response => this.car = response.data.car)
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            CarService.update(this.car)
                .then(response => {
                    this.car = response.data.car
                    this.message = "Изменения сохранены"
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>

