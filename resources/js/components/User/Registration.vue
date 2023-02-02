<template lang="">
    <div>
        <form class="w-25">
            <input v-model="name" type="text" class="form-control mt-3 mb-3" placeholder="Your Name">
            <input v-model="email" type="email" class="form-control mb-3" placeholder="Your E-Mail" name="">
            <input v-model="password" type="password" class="form-control mb-3" placeholder="Password" name="">
            <input v-model="password_confirmation" type="password" class="form-control mb-3" placeholder="Repeat Password" name="" >
            <input @click.prevent="store" type="submit" class="btn btn-primary">
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: null,
        }
    },
    methods: {
        store() {
            axios.post('/api/users', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }).then( res => {
                console.log(res)
            })
        }
    },
}
</script>
<style lang="">
    
</style>