<template lang="">
    <div>
        <div class="w-25">
            <input type="email" class="form-control mt-3 mb-3" placeholder="Your Email" v-model="email" name="" id="">
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="password" name="" id="">
            <input @click.prevent="login" type="submit" class="btn btn-primary" >
        </div>
    </div>
</template>
<script>
export default {
    name: 'login',
    data() {
        return {
            email: "",
            password: "", 
        }
    },
    methods: {
        login () {
            axios.post('/api/login', {email:this.email, password:this.password})
            .then( res => {
                console.log(res.data.authorisation.token);
                localStorage.setItem('access_token', res.data.authorisation.token);
                this.$router.push('personal')
            }) 
        }
    },
}
</script>
<style lang="">
    
</style>