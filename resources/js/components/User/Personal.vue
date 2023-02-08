<template lang="">
    <section class="personal-sec">
        <div class="pers-cont">
            <h2>PERSONAL</h2>
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
                name: '',
                email: '',
                created_at: ''

            }
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
         this.info.email = res.data.email
            this.info.name = res.data.name
            this.info.created_at = res.data.created_at
        })
       .catch(error => {
        console.log(error);
       })



    },


}
</script>
<style lang="scss" scoped>
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
    }

    @media screen and (max-width: 500px) {
        .pers-cont{
            width: 80%;
        }
    }
</style>