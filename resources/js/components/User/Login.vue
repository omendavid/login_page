<template lang="">
    <div>
        <div class="w-25">
            <input type="email" class="form-control mt-3 mb-3" placeholder="Your Email" v-model="email" name="">
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="password" name="">
            <input @click.prevent="login" type="submit" class="btn btn-primary" >
        </div>
        <div v-if="error" class="text-danger">{{ error }}</div>
    </div>
</template>
<script>
export default {
    name: 'login',
    data() {
        return {
            email: "",
            password: "", 
            error: null,
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
            .catch( error => {
                console.log(error.response);
                this.error = error.response.data.message
            })
        }
    },
}
</script>
<style lang="">
    
</style>