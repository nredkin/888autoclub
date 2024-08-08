<template>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ title }}</label>
    <div>
        <VueMultiselect
            :options="values"
            v-model="selectedValue"
            :multiple="multiple"
            :label="label"
            track-by="id"
            :close-on-select="!multiple"
            placeholder="Поиск">
        </VueMultiselect>
    </div>
</template>

<script>
import VueMultiselect from "vue-multiselect";

export default {
    components: { VueMultiselect },
    emits: ['update:value'],
    props: {
        value: {
            type: Array,
            default: () => []
        },
        title: String,
        values: {
            type: Array,
            default: () => []
        },
        multiple: {
            type: Boolean,
            default: true,
        },
        label: {
            type: String,
            default: "name",
        },
    },
    computed: {
        selectedValue: {
            get() {
                if (this.multiple) {
                    return this.values.filter(item => this.value.includes(item.id));
                } else {
                    return this.values.find(item => item.id === this.value[0]) || null;
                }
            },
            set(newValue) {
                if (this.multiple) {
                    const newIds = newValue.map(item => item.id);
                    this.$emit('update:value', newIds);
                } else {
                    const newId = newValue ? [newValue.id] : [];
                    this.$emit('update:value', newId);
                }
            }
        }
    },
    watch: {
        value: {
            handler(newValue) {
                if (!Array.isArray(newValue)) {
                    console.warn('Expected value prop to be an array');
                    this.$emit('update:value', []);
                }
            },
            immediate: true
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>


<!--<template>-->

<!--    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{title}}</label>-->

<!--    <div>-->
<!--        <VueMultiselect-->
<!--            :options="values"-->
<!--            v-model="internalValue"-->
<!--            :multiple="multiple"-->
<!--            label="name"-->
<!--            track-by="name"-->
<!--            :close-on-select="true"-->
<!--            placeholder="Поиск">-->
<!--        </VueMultiselect>-->
<!--    </div>-->

<!--</template>-->

<!--<script>-->
<!--import VueMultiselect from "vue-multiselect";-->
<!--export default {-->
<!--    components: { VueMultiselect },-->
<!--    emits: ['update:value'],-->
<!--    props: {-->
<!--        value: Array,-->
<!--        title: String,-->
<!--        values: Array|Object,-->
<!--        multiple: {-->
<!--            type: Boolean,-->
<!--            default: true,-->
<!--        },-->
<!--    },-->
<!--    data: function () {-->
<!--        return {-->
<!--            internalValue: this.value,-->
<!--        };-->
<!--    },-->
<!--    methods: {-->
<!--        emitUpdatedValue(newValue) {-->
<!--            this.$emit("update:value", newValue);-->
<!--        },-->
<!--    },-->
<!--    watch: {-->
<!--        internalValue(newVal) {-->
<!--            this.emitUpdatedValue(newVal.id);-->
<!--        },-->
<!--    },-->

<!--}-->

<!--</script>-->

<!--<style src="vue-multiselect/dist/vue-multiselect.css"></style>-->
