<template>
    <label :for="name"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
    >{{title}}</label>
    <select
        :name="name"
        :value="value"
        :disabled="disabled"
        @input="$emit('update:value', $event.target.value)"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option v-for="value of values" :key="value.id" :value="value.id">
            {{ value.name }}
        </option>
    </select>
</template>

<script>
export default {
    props: {
        name: String,
        value: Number|String,
        title: String,
        values: Array,
        disabled: false

    },
    name: "MySelect"
}
</script>
