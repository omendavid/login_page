<template lang="">
    <section class="personal-sec">
        <div class="show-img" v-if="show" @click="showDiv">
                <img :src="info.img" alt="">
            </div>
        <div class="pers-cont">
            
            <h2>PERSONAL</h2>
            <img :src="info.img_croped" alt="" @mousedown="showDiv">
            <h3>Name: {{ info.name }}</h3>
            <h3>E-Mail: {{ info.email }}</h3>
            <h4>Created at: {{ info.created_at }}</h4>
        </div>
    </section>
</template>
<script>
import VueJwtDecode from 'vue-jwt-decode'
import API from '../../api'
export default {
    name: 'Personal',
    data() {
        return {
            info: {
                img: '',
                img_croped: '',
                name: '',
                email: '',
                created_at: ''
            },
            show: false,
        }
    },
    mounted() {
        let token = localStorage.getItem('access_token')

       console.log(token)

       let decoded = VueJwtDecode.decode(token);

       console.log(decoded)

       let id = decoded.sub

       console.log(id)

       axios.post('../api/users/getuser' , {id: id})
        .then(res=> {
         console.log(res)

            this.info.img = res.data.img
            this.info.img_croped = res.data.img_croped
            this.info.email = res.data.email
            this.info.name = res.data.name
            this.info.created_at = res.data.created_at
            console.log(this.info.img);
        })
       .catch(error => {
        console.log(error);
       })



    },

    methods: {
        showDiv() {
            this.show = !this.show
        }
    },


}
</script>
<style lang="scss" scoped>
.show-img {
    position: fixed;
    width: 100vw;
    height: 100vh;
    bottom: 50%;
    transform: translateY(50%);
    background: rgba(0, 0, 0, 0.652);
    backdrop-filter: blur(5px);
    display: flex;
    z-index: 3;
    img{
        max-width: 45%;
        margin: auto auto;
    }
}
    .personal-sec{
        width: 100%;
        height: 90vh;
        display: flex;
    }
    .pers-cont{
        background: rgba(147, 147, 147, 0.115);
        backdrop-filter: blur(10px);
        width: 60%;
        height: 60%;
        color: rgb(30, 3, 39);
        margin: auto auto;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        align-items: center;
        h3, h4{
            color: rgb(190, 190, 190);
        }

        & > img{
            max-width: 20%;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }


    }

    @media screen and (max-width: 650px) {

        .show-img{
            img{
                max-width: 80%;
            }
        

    }

    @media screen and (max-width: 500px) {
        .pers-cont{
            width: 80%;
        }
        }
    }
</style>
