<template>
    <div>
        <div class="grid md:grid-cols-3 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Фамилия клиента" v-model:value="userable.lastName" type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Имя клиента" v-model:value="userable.firstName" type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Отчество клиента" v-model:value="userable.middleName" type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <MultiSelect
                    title="Категории клиента"
                    v-model:value="userable.categoryIds"
                    :values="categories || []"
                    :multiple="true"
                />
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Номер телефона" name="phoneNumber" v-model:value="userable.phoneNumber"
                           type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <DateInput title="Дата рождения" name="birthday" v-model:value="userable.birthday" type="date"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Серия паспорта" name="passportSeries" v-model:value="userable.passportSeries"
                           type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Номер паспорта" name="passportNumber" v-model:value="userable.passportNumber"
                           type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Паспорт выдан" name="passportNotes" v-model:value="userable.passportNotes"
                           type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <DateInput title="Дата выдачи паспорта" name="passportIssueDate" v-model:value="userable.passportIssueDate" type="date"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="ИНН" name="inn" v-model:value="userable.inn"
                           type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <DateInput title="Дата последней проверки клиента ФССП" name="lastCheckFssp" v-model:value="userable.lastCheckFssp"
                           type="date"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <DateInput title="Дата последней проверки клиента по исполнительным производствам" name="lastCheckEnforcement" v-model:value="userable.lastCheckEnforcement"
                           type="date"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <TextInput title="Адрес прописки" name="registrationAddress"
                           v-model:value="userable.registrationAddress"
                           type="text"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <Textarea title="Жалобы" name="complaints" v-model:value="userable.complaints"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <Textarea title="Комментарий" name="comment" v-model:value="userable.comment"/>
            </div>
            <!-- Add other userable fields here -->
        </div>

        <!--Блок клубные карты-->
        <ClubCards v-if="userable.id" :client="userable"/>

    </div>

</template>

<script>

import TextInput from "../forms/TextInput.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import MultiSelect from "../forms/MultiSelect.vue";
import {CategoryService} from "../../services/CategoryService";
import {get} from 'lodash';
import ClubCards from "./ClubCards.vue";

export default {
    components: {ClubCards, MultiSelect, TextInput, DateInput, Textarea},
    name: 'ClientFields',
    props: {
        userable: Object,
    },
    data: function () {
        return {
            categories: [],
        }
    },
    created: async function () {
        CategoryService.getCategories().then(response => {
            this.categories = get(response, 'data.categories', []);
        });
    },
};
</script>
