<template lang="">
    <div>
        <Header @logOut="logOut"
        v-bind="{screenSize,accessToken}" />
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
            screenSize: 0
        }
    },
    components: {
        Header
    },

    watch: {
        currentRoute:{
            handler(value) {
                this.getAccessToken()
            },
            immediate:true
        }
    },
    
    mounted() {
        this.getAccessToken()

        this.screenSize = window.screen.width

        window.onresize=()=>{
            this.screenSize = window.screen.width
        }
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