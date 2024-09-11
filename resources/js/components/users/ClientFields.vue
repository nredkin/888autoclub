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

            <div v-if="userable.id"  class="relative z-0 w-full mb-6 group">
                <TextInput title="Номер договора" name="contractNumber" v-model:value="userable.contractNumber"
                           type="text"/>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <my-select v-model:value="userable.type" title="Тип" :values="types"/>
            </div>


        </div>

        <div v-if="userable.type == 1">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Юридическое лицо</h3>

            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Наименование компании" name="companyName" v-model:value="userable.companyName"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="ОГРН" name="regNumber" v-model:value="userable.regNumber"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Юридический адрес" name="jurAddress" v-model:value="userable.jurAddress"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Фактический адрес" name="factAddress" v-model:value="userable.factAddress"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Директор" name="director" v-model:value="userable.director"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Textarea title="Данные банка" name="bankDetails" v-model:value="userable.bankDetails"/>
                </div>
            </div>

        </div>



<!--        <div class="grid md:grid-cols-2 md:gap-6">-->
            <div class="w-full mb-6 group">
                <ClubCards v-if="userable.id" :client="userable"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <a href="#" @click="downloadContract(contractTypes.card, $event)" class="text-blue-600 font-medium">Создать договор по клубной карте</a>
            </div>
            <div class="w-full mb-6 group">
                <Balance v-if="userable.id" :userId="userId"/>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <a href="#" @click="downloadContract(contractTypes.withoutDriver, $event)" class="text-blue-600 font-medium">Создать договор аренды без экипажа</a>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <a href="#" @click="downloadContract(contractTypes.withDriver, $event)" class="text-blue-600 font-medium">Создать договор аренды с экипажем</a>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <a href="#" @click="downloadContract(contractTypes.certificate, $event)" class="text-blue-600 font-medium">Скачать договор на подарочный сертификат</a>
            </div>
            <div class="w-full mb-6 group">
                <Files :modelId="userId" modelType="user"/>
            </div>
<!--        </div>-->


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
import Balance from "./Balance.vue";
import Files from "../common/Files.vue"
import fileDownload from "js-file-download";
import {UserService} from "../../services/UserService";
import { EventBus } from '../../helpers/eventBus';
import MySelect from "../forms/MySelect.vue";

export default {
    components: {MySelect, ClubCards, Balance, Files, MultiSelect, TextInput, DateInput, Textarea},
    name: 'ClientFields',
    props: {
        userable: Object,
        userId: null,
    },
    data: function () {
        return {
            categories: [],
            contractTypes: {
                withoutDriver: 'without_driver',
                withDriver: 'with_driver',
                card: 'card',
                certificate: 'certificate',
            },
            types: [
                {id:0, name:'Физ.лицо'},
                {id:1, name:'Юр.лицо'},
            ],
        }
    },
    created: async function () {
        CategoryService.getCategories().then(response => {
            this.categories = get(response, 'data.categories', []);
        });
    },
    methods: {
        downloadContract: function(type, event) {
            event.preventDefault()
            UserService.downloadContract(this.userId, type)
                .then(response => {
                    fileDownload(response.data, `${this.userId}-contract_${type}.docx`);
                    EventBus.emit('refresh-files');
                })
                .catch(error => this.errors = error)
        },
    },
};
</script>
