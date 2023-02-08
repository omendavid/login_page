<template lang="">
    <header>
        <div class="header-cont">
            <div class="header-c-flex">
                <div class="h-c-f-home"><h2><router-link :to="{ name: 'fruit.index' }">HOME</router-link></h2></div>
                <div class="h-c-f-user" v-if="screenSize > 750">
                    <router-link :to="{ name: 'fruit.index' }">LIST</router-link>
                    
                    <router-link v-if="!accessToken" :to="{ name: 'users.registration' }">REGISTRATION</router-link>
                    
                    <router-link v-if="!accessToken" :to="{ name: 'user.login' }">LOGIN</router-link>
                    
                    <router-link v-if="accessToken" :to="{ name: 'user.personal' }">PERSONAL</router-link>
                    
                    <a href="#" v-if="accessToken" @click.prevent="$emit('logOut')">LOG OUT</a>
                </div>
                <div class="h-c-f-user mobile" v-else>
                    <ul>
                        <li class="burg-men-cont" @click="openMenu">
                            <span class="burg-men" :class="menuClassName">
                            </span>
                        </li>
                        <ul class="menu" :class="(isMenuOpen == true)?('opened'):('')">
                            <router-link :to="{ name: 'fruit.index' }">LIST</router-link>
                    
                            <router-link v-if="!accessToken" :to="{ name: 'users.registration' }">REGISTRATION</router-link>

                            <router-link v-if="!accessToken" :to="{ name: 'user.login' }">LOGIN</router-link>

                            <router-link v-if="accessToken" :to="{ name: 'user.personal' }">PERSONAL</router-link>

                            <a href="#" v-if="accessToken" @click.prevent="$emit('logOut')">LOG OUT</a>
                        </ul>
                    </ul>
                </div>

            </div>
        </div>
    </header>
</template>
<script>
export default {
    name: "Header",
    data() {
        return {
            isMenuOpen: false,
            menuClassName: ''
        }
    },
    props: {
        accessToken: {
            type: String
        },
        screenSize: {
            type: Number
        }
    },
    methods: {
        openMenu() {
            this.isMenuOpen = !this.isMenuOpen
            if(this.isMenuOpen == true) {
                this.menuClassName = 'open';
            }else{
                this.menuClassName = '';
            }
        }
    },

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
            
            h2{
                margin: 0;
                a{
                    text-decoration: none;
                    color: inherit;
                }
            }           
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

    .burg-men{
        position: relative;
        display: block;
        height: 2px;
        background-color: white;
        width: 20px;
        transition: all 0.3s ease;
        z-index: 2;
        &::after{
            position: absolute;
            content: '';
            transform: translateY(-8px);
            left: 0;
            height: 2px;
            width: 20px;
            background-color: white;
            transition: all 0.3s ease;
        }
        &::before{
            position: absolute;
            content: '';
            transform: translateY(8px);
            left: 0;
            height: 2px;
            width: 20px;
            background-color: white;
            transition: all 0.3s ease;
        }

    }

    .mobile{
        ul{
            padding: 0;
            margin: 0;
        }
        justify-content: end !important;
        align-items: flex-end;
        position: relative;
        .burg-men-cont{
            padding: 100% 0;
            height: 42px;
            width: 20px;
        }
        .menu{
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            padding: 7.46vw 5.3vw;
            box-sizing: border-box;
            transform: translate(150%, 0%);
            transition: all 0.6s cubic-bezier(0, 0, 0.08, 1);
            background-color: rgb(69, 11, 69);
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }
        
    }

    .open {
        transform: translateX(-50px);
        background: transparent;
        position: fixed;
        &::after{
            transform: rotate(45deg) translate(34px, -34px);
        }
        &::before{
            transform: rotate(-45deg) translate(34px, 34px);
        }
    }

    .opened{
        transform: translate(0%, 0%) !important;
    }
    
@media screen and (max-width: 900px) {
    .header-c-flex{
        .h-c-f-user{
            width: 40vw;
            
        }
    }
    
}

</style>