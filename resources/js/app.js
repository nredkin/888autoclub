import './bootstrap';
import 'flowbite';
import '@vueform/multiselect/themes/default.css'

import {createApp} from 'vue'
import {createRouter, createWebHashHistory} from 'vue-router'

import App from './components/App.vue'
import UsersList from "./components/users/UsersList.vue";
import UserCreateForm from "./components/users/UserCreateForm.vue";
import UserEditForm from "./components/users/UserEditForm.vue";
import BranchesList from "./components/branches/BranchesList.vue";
import BranchCreateForm from "./components/branches/BranchCreateForm.vue";
import BranchEditForm from "./components/branches/BranchEditForm.vue";
import CategoriesList from "./components/categories/CategoriesList.vue";
import CategoryCreateForm from "./components/categories/CategoryCreateForm.vue";
import CategoryEditForm from "./components/categories/CategoryEditForm.vue";

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            component: UsersList
        },
        //Пользователи
        {
            name: 'listUsers',
            path: '/users',
            component: UsersList
        },
        {
            name: 'createUser',
            path: '/users/create',
            component: UserCreateForm
        },
        {
            name: 'editUser',
            path: '/users/:id',
            component: UserEditForm
        },
        //Филиалы
        {
            name: 'listBranches',
            path: '/branches',
            component: BranchesList
        },
        {
            name: 'createBranch',
            path: '/branches/create',
            component: BranchCreateForm
        },
        {
            name: 'editBranch',
            path: '/branches/:id',
            component: BranchEditForm
        },
        //Категории пользователей
        {
            name: 'listCategories',
            path: '/categories',
            component: CategoriesList
        },
        {
            name: 'createCategory',
            path: '/categories/create',
            component: CategoryCreateForm
        },
        {
            name: 'editCategory',
            path: '/categories/:id',
            component: CategoryEditForm
        },



    ],
    linkActiveClass: 'bg-gray-200'
})

createApp(App).use(router).mount('#app')
