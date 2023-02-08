<template lang="">
    <section class="login">
        <form class="form">
            <h2>LOG IN</h2>
            <label class="border" for="">
            <input type="email" class="form-control" placeholder="Your Email" v-model="email" name="">
            </label>
            <label class="border" for="">
            <input type="password" class="form-control" placeholder="Password" v-model="password" name="">
            </label>
            <button @click.prevent="login" type="submit" class="neon-button" >SUBMIT</button>
            <div v-if="error" class="text-danger">{{ error }}</div>
        </form>
        
    </section>
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
<style lang="scss" scoped>
     .login{
        width: 100%;
        height: 80vh;
        display: flex

    }
    
    .form{
        background: rgba(147, 147, 147, 0.115);
        backdrop-filter: blur(10px);
        padding: 1vw;
        border-radius: 5px;
        width: 25%;
        box-sizing: border-box;
        margin: auto auto;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        height: 60%;

        h2{
            color:rgb(30, 3, 39);
        }
        
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
                color: rgb(132, 132, 132);
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
        // .btn{
        //     background-color: rgb(149, 18, 138);
        //     border-color: rgb(126, 16, 117);
        //     margin: 10px 0px;
        //     transition: all 0.3s ease;
        //     &:hover{
        //         margin: 0;
        //         padding: 10px 20px;
        //         background-color: rgb(126, 16, 117);
        //     }
        // }
        .neon-button {
            font-size: 16px;

            display: inline-block;
            cursor: pointer;
            text-decoration: none;
            color: hsl(317 100% 54%);
            border: hsl(317 100% 54%) 0.125em solid;
            padding: 0.25em 1em;
            border-radius: 0.25em;
            background: transparent;
            text-shadow: 0 0 0.125em hsl(0 0% 100% / 0.3), 0 0 0.45em currentColor;

            box-shadow: inset 0 0 0.5em 0 hsl(317 100% 54%), 0 0 0.5em 0 hsl(317 100% 54%);
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }

        .neon-button::before {
          pointer-events: none;
          content: "";
          position: absolute;
          background: hsl(317 100% 54%);
          top: 90%;
          left: 0;
          width: 100%;
          height: 100%;
        
          transform: perspective(1em) rotateX(40deg) scale(1, 0.35);
          filter: blur(1em);
          opacity: 0.7;
          transition: opacity 100ms linear;
        }

        .neon-button::after {
          content: "";
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          box-shadow: 0 0 2em 0.5em hsl(317 100% 54%);
          opacity: 0;
          background-color: hsl(317 100% 54%);
          z-index: -1;
          transition: opacity 100ms linear;
        }

        .neon-button:hover,
        .neon-button:focus {
            background: hsl(317 100% 54%);
          color: hsl(323 21% 16%);
          text-shadow: none;
          
        }

        .neon-button:hover::before,
        .neon-button:focus::before {
          opacity: 1;
        }
        .neon-button:hover::after,
        .neon-button:focus::after {
          opacity: 1;
        }

    }

    @media screen and (max-width: 1200px) {
        .form{
            width: 50%;
        }
    }

    @media screen and (max-width: 600px) {
        .form{
            width: 80%;
        }
    }


</style>