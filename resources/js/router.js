import { createRouter,createWebHistory } from "vue-router"
import Fruit from './components/Fruits/Fruit.vue'
import Login from './components/User/Login.vue'
import Registration from './components/User/Registration.vue'
import Personal from './components/User/Personal.vue'
import { useSSRContext } from "vue"



const route = new createRouter({
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
        {
            path: '/:pathMatch(.*)*',
            component: Personal,
            name: '404'
        },
    ]
})




route.beforeEach((to, from, next) => {
    const authorisationToken = localStorage.getItem('access_token')

    if(!authorisationToken){
        if (to.name === 'user.login' || to.name === 'users.registration') {
            return next()
        } else {
            return next({ name: 'user.login' })
        }
    }

    if( to.name === 'user.login' || to.name === 'users.registration' && authorisationToken){
        return next({ name: 'user.personal' })
    }

    next()
})


export default route