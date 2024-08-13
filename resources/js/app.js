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
import ClubCardLevelsList from "./components/clubCardLevels/ClubCardLevelsList.vue";
import CarsList from "./components/cars/CarsList.vue";
import CarCreateForm from "./components/cars/CarCreateForm.vue";
import CarEditForm from "./components/cars/CarEditForm.vue";
import ServicesList from "./components/services/ServicesList.vue";
import ServiceCreateForm from "./components/services/ServiceCreateForm.vue";
import ServiceEditForm from "./components/services/ServiceEditForm.vue";
import DealsList from "./components/deals/DealsList.vue";
import DealCreateForm from "./components/deals/DealCreateForm.vue";
import DealEditForm from "./components/deals/DealEditForm.vue";
import OperationsList from "./components/operations/OperationsList.vue";
import ExpenseItemsList from "./components/expenseItems/ExpenseItemsList.vue";
import ExpenseItemCreateForm from "./components/expenseItems/ExpenseItemCreateForm.vue";
import ExpenseItemEditForm from "./components/expenseItems/ExpenseItemEditForm.vue";

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
        //Уровни карт
        {
            name: 'listClubCardLevels',
            path: '/clubCardLevels',
            component: ClubCardLevelsList
        },
        //Автомобили
        {
            name: 'listCars',
            path: '/cars',
            component: CarsList
        },
        {
            name: 'createCar',
            path: '/cars/create',
            component: CarCreateForm
        },
        {
            name: 'editCar',
            path: '/cars/:id',
            component: CarEditForm
        },
        //Услуги
        {
            name: 'listServices',
            path: '/services',
            component: ServicesList
        },
        {
            name: 'createService',
            path: '/services/create',
            component: ServiceCreateForm
        },
        {
            name: 'editService',
            path: '/services/:id',
            component: ServiceEditForm
        },
        //Сделки
        {
            name: 'listDeals',
            path: '/deals',
            component: DealsList
        },
        {
            name: 'createDeal',
            path: '/deals/create',
            component: DealCreateForm
        },
        {
            name: 'editDeal',
            path: '/deals/:id',
            component: DealEditForm
        },
        //Финансовые операции
        {
            name: 'listOperations',
            path: '/operations',
            component: OperationsList
        },
        //Статьи расходов
        {
            name: 'listExpenseItems',
            path: '/expenseItems',
            component: ExpenseItemsList
        },
        {
            name: 'createExpenseItem',
            path: '/expenseItems/create',
            component: ExpenseItemCreateForm
        },
        {
            name: 'editExpenseItem',
            path: '/expenseItems/:id',
            component: ExpenseItemEditForm
        },




    ],
    linkActiveClass: 'bg-gray-200'
})

createApp(App).use(router).mount('#app')
