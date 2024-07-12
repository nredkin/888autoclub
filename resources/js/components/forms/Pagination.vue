<template>
    <nav class="my-3">
        <ul class="inline-flex -space-x-px">
            <li>
                <router-link
                    v-if="!stopPrev"
                    :to="{path: url,query:{page:goPrev}}"
                    class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Предыдущая
                </router-link>
                <span
                    v-else
                    :to="{path: url,query:{page:goPrev}}"
                    class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Предыдущая
                </span>
            </li>
            <li v-for="page in pages">
                <router-link
                    :to="{path: url, query:{page:page}}"
                    :class="{'text-blue-600': currentPage === page}"
                    class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {{ page }}
                </router-link>
            </li>
            <li>
                <router-link
                    v-if="!stopForward"
                    :to="{path: url,query:{page:this.goForward}}"
                    class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Следующая
                </router-link>
                <span v-else
                      :to="{path: url,query:{page:this.goForward}}"
                      class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Следующая
                </span>
            </li>
        </ul>
    </nav>
</template>

<script>
import {range} from "../../helpers/utils";
import {step} from "../../helpers/vars";

export default {
    name: "Pagination",
    data: () => ({isDisabled: true}),
    props: {
        total: {
            type: Number,
            required: true
        },
        limit: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    },
    methods: {},
    computed: {
        step() {
            return step
        },
        pages() {
            const pagesCount = Math.ceil(this.total / this.limit)
            return range(1, pagesCount)
        },
        goForward() {
            return `${this.currentPage + this.step}`
        },
        goPrev() {
            return `${this.currentPage - this.step}`
        },
        stopForward() {
            return this.currentPage === this.pages.length
        },
        stopPrev() {
            return this.currentPage === 1
        }
    },
}
</script>

<style scoped>

</style>
