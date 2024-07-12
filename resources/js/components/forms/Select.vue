<template>
    <label :for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{title}}</label>

    <!--<template v-if="type !== 'multi' ">-->
    <!--    <select-->
    <!--        :name="name"-->
    <!--        :value="value"-->
    <!--        :disabled="disabled"-->
    <!--        @input="$emit('update:value', $event.target.value)"-->
    <!--        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">-->
    <!--        <option v-for="value of values" :key="value.id" :value="value.id">-->
    <!--            {{ value.name }}-->
    <!--        </option>-->
    <!--    </select>-->
    <!--</template>-->

    <!--<template v-if="type === 'multi'">-->
    <VueMultiselect
        :options="values"
        v-model="internalValue"
        label="name"
        openDirection="bottom"
        :close-on-select="true"
        :clear-on-select="true"
        :show-labels="false"
        :max-height="maxHeight"
        :placeholder="placeholder"
    ><template v-slot:noResult> <span>По запросу ничего не найдено</span> </template>
    </VueMultiselect>
    <!--</template>-->


</template>

<script>
import VueMultiselect from "vue-multiselect";
export default {
    name: "Select",
    components: { VueMultiselect },
    emits: ['update:value', 'update:clearEvent'],

    props: {
        type: String,
        placeholder: {
            type: String,
            default: 'Поиск',
        },
        name: String,
        value: [Array, Object, Number, String],
        title: String,
        maxHeight: Number,
        values: Array|Object,
        disabled: false,
        clearEvent: false
    },
    data: function () {
        return {
            internalValue: this.value,
        };
    },
    methods: {
        emitUpdatedValue(newValue) {
            this.$emit("update:value", newValue);
        },
    },
    watch: {
        internalValue(newVal) {
            this.emitUpdatedValue(newVal.id);
        },
        clearEvent() {
            this.internalValue = '';
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style >
.multiselect__tags {
    background-color: #f9fafb;
}
.multiselect__placeholder {
    color: #1a202c;
}
.multiselect__input, .multiselect__single{
    background: none;
}
</style>
