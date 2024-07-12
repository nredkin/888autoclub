<template>
    <input
        :name="name"
        :value="!!checked"
        :checked="!!checked"
        type="checkbox"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        @input="$emit('update:checked', $event.target.checked)"
    >
    <label :for="name" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{title}}</label>
</template>

<script>
export default {
    props: {
        name: String,
        title: String,
        checked: Boolean
    },
    name: "Checkbox"
}
</script>

<style scoped>

</style>
