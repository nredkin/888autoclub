<template>
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
                value-prop="value"
            />
        </div>
        <!-- Add other userable fields here -->
    </div>
</template>

<script>

import TextInput from "../forms/TextInput.vue";
import MySelect from "../forms/MySelect.vue";
import MultiSelect from "../forms/MultiSelect.vue";
import {CategoryService} from "../../services/CategoryService";
import { get } from 'lodash';
export default {
    components: {MultiSelect, TextInput, MySelect},
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
