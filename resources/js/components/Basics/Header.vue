<template lang="">
    <header>
        <div class="header-cont">
            <div class="header-c-flex">
                <div class="h-c-f-home"><h2>Home</h2></div>
                <div class="h-c-f-user">
                    <router-link :to="{ name: 'fruit.index' }">LIST</router-link>
                    
                    <router-link v-if="!accessToken" :to="{ name: 'users.registration' }">REGISTRATION</router-link>
                    
                    <router-link v-if="!accessToken" :to="{ name: 'user.login' }">LOGIN</router-link>
                    
                    <router-link v-if="accessToken" :to="{ name: 'user.personal' }">PERSONAL</router-link>
                    
                    <a href="#" v-if="accessToken" @click.prevent="logOut">LOG OUT</a>
                </div>
            </div>
        </div>
    </header>
</template>
<script>
export default {
    name: "Header"
}
</script>
<style lang="scss" scoped>



header{
    background: rgb(41, 29, 41);
    padding: 10px 30px;
    
}
    .header-c-flex{
        display: flex;
        justify-content: space-between;
        align-items: center;
        .h-c-f-home{
            color: white;
        }
        .h-c-f-user{
            width: 30%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            a{
            color: white;
            text-decoration: none;
            position: relative;
            &::before{
                position: absolute;
                content: '';
                height: 2px;
                bottom: 0;
                left: 0;
                width: 0;
                background-color: rgb(255, 0, 123);
                transition: all 0.3s ease;
            }
            &:hover{
             &::before{
                width: 100%;
             }   
            }
            }
        }
        
        
    }
    
</style>