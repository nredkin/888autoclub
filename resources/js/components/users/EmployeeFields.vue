<template>
    <div class="grid md:grid-cols-3 md:gap-6">
        <div class="relative z-0 w-full mb-6 group">
            <TextInput title="Фамилия сотрудника" v-model:value="userable.lastName" type="text"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <TextInput title="Имя сотрудника" v-model:value="userable.firstName" type="text"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <TextInput title="Отчество сотрудника" v-model:value="userable.middleName" type="text"/>
        </div>
        <div class="relative z-1 w-full mb-6 group">
            <my-select name="branchId" v-model:value="userable.branchId" title="Филиал" :values="branches"/>
        </div>
        <!-- Add other userable fields here -->
    </div>
</template>

<script>

import TextInput from "../forms/TextInput.vue";
import MySelect from "../forms/MySelect.vue";
import {BranchService} from "../../services/BranchService";
export default {
    components: {TextInput, MySelect},
    name: 'EmployeeFields',
    props: {
        userable: Object,
    },
    data: function () {
        return {
            branches: [],
        }
    },
    created: async function () {
        BranchService.getBranches().then(response => this.branches = response.data.branches)
    },
};
</script>
