import  router  from "./router";
import  Axios  from "axios";


const api = Axios.create();


// start request

api.interceptors.request.use(config => {

    if (localStorage.getItem('access_token')) {
        config.headers = {
            'authorization': `Bearer ${localStorage.getItem('access_token')}`
        }
    }

    return config
}, error => {
    
})

// end request


api.interceptors.response.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers = {
            'authorization': `Bearer ${localStorage.getItem('access_token')}`
        }
    }
    return config
}, error => {
    if (error.response.status === 401) {
        router.push('user.login')
    }
})


export default api