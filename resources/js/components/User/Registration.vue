<template lang="">
    <section class="register">
        <form class="w-25 form">
            <label class="border">
            <input v-model="name" type="text" class="form-control" placeholder="Your Name">
            </label>
            <label class="border">
            <input v-model="email" type="email" class="form-control" placeholder="Your E-Mail" name="">
            </label>
            <label class="border">
            <input v-model="password" type="password" class="form-control" placeholder="Password" name="">
            </label>
            <label class="border">
            <input v-model="password_confirmation" type="password" class="form-control" placeholder="Repeat Password" name="" >
            </label>
            <input @click.prevent="store" type="submit" class="btn btn-primary">
        </form>
        <div v-if="error" class="text-danger">{{ error }}</div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: null,
            error: null
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
                localStorage.setItem('access_token' , res.data.access_token)
                this.$router.push({ name: 'user.personal'})
            }).catch( error => {
                console.log(error.response);
                this.error = error.response.data.message
            })
        }
    },
}
</script>
<style lang="scss" scoped>
    .register{
        width: 100%;
        height: 80vh;
        display: flex

    }
    .form{
        margin: auto auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        height: 80%;
        .border{
            position: relative;
            width: 100%;
            border: none !important;
            
        }
        .border::after{
                position: absolute;
                content: '';
                bottom: 0;
                left: 0;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, rgba(0,202,255,1) 0%, rgba(153,0,161,1) 50%, rgba(194,0,173,1) 100%,);
                transition: all 0.3s ease;
            }
        .form-control{
            background: transparent;
            color: whitesmoke;
            border: none;
            border-radius: 0;
            transition: all 0.3s ease;
            position: relative;
            &::placeholder{
                color: whitesmoke;
            }
        }
            .form-control:focus {
                 .form .border::after{
                    background: linear-gradient(90deg,  rgba(194,0,173,1) 0%, rgba(153,0,161,1) 50%, rgba(0,202,255,1) 100%);
                }   
            }
           
            
        .form-control:focus{
            background: white;
            color: black;
            box-shadow: 0 0 0 0.25rem rgb(255 0 123 / 25%);
            &::placeholder{
                color: black;
            }
            
        }
        .btn{
            background-color: rgb(149, 18, 138);
            border-color: rgb(126, 16, 117);
            margin: 10px 0px;
            transition: all 0.3s ease;
            &:hover{
                margin: 0;
                padding: 10px 20px;
                background-color: rgb(126, 16, 117);
            }
        }
    }

    
</style>