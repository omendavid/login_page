import { createRouter,createWebHistory } from "vue-router"
import Fruit from './components/Fruits/Fruit.vue'
import Login from './components/User/Login.vue'
import Registration from './components/User/Registration.vue'
import Personal from './components/User/Personal.vue'


export default new createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/fruits',
            component: Fruit,
            name: 'fruit.index'
        },
        {
            path: '/user/login',
            component: Login,
            name: 'user.login'
        },
        {
            path: '/users/registration',
            component: Registration,
            name: 'users.registration'
        },
        {
            path: '/user/personal',
            component: Personal,
            name: 'user.personal'
        },
    ]
})
