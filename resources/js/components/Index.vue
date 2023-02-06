<template lang="">
    <div>
        <Header :accessToken="accessToken" />
        <router-view></router-view>
    </div>
</template>
<script>

import API from '../api'
import Header from './Basics/Header.vue'

export default {
    name: 'Index',
    data() {
        return {
            accessToken: '',
        }
    },
    components: {
        Header
    },

    watch: {
        currentRoute:{
            handler(value,prevvalue) {
                this.getAccessToken()
            },
            immediate:true
        }
    },
    
    mounted() {
        this.getAccessToken()
    },

    methods: {
        getAccessToken() {
            this.accessToken = localStorage.getItem('access_token')
        },
        logOut() {
            API.post('/api/logout')
            .then( res => {
                localStorage.removeItem('access_token')
                this.$router.push({name: 'user.login'})
            })
        }
    },
    computed:{
        currentRoute(){
            return this.$route.name
        }
    }

}
    
</script>
<style lang="scss">
*{
    padding: 0;
    margin:  0;
    box-sizing: border-box;
}
    body{
        background: rgb(78, 78, 78);
    }   
</style>