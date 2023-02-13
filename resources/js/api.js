import  router  from "./router";
import axios from "axios";


const api = axios.create();


// start request

api.interceptors.request.use(config => {

    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
        
    }

    return config
}, error => {
    
})

// end request


// start response

api.interceptors.response.use(config => {
    if (localStorage.getItem('access_token')) {
        config.headers.authorization = `Bearer ${localStorage.getItem('access_token')}`
    }
    return config
}, error => {
    console.log(error.response.data.message)
    if (error.response.data.message === 'Token has expired') {
        console.log('error if')
        return axios.post('../api/refresh', {} , {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('access_token')}`
            }
        }).then( res => {
            console.log('then')
            localStorage.setItem('access_token', res.data.authorisation.token)


            error.config.headers['Authorization'] = `Bearer ${res.data.authorisation.token}`

            return api.request(error.config)
        })
    }
    console.log(error.response.status)
    if (error.response.status === 401) {
        router.push( { name: 'user.login' } )
    }
})


export default api