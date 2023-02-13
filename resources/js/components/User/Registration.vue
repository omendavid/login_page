<template lang="">
    <section class="register">
        <div class="overlaping-div" v-if="img_preview !== null && done == false">
                <div class="o-d-f-c">
                    <div class="o-d-f-item">
                        <label class="crop-label border" for="" >
                            <Crop :img_preview="img_preview" @destination-change="dest" />
                        </label>

                        <img v-show="image !== null" :src="destination" class="float-img">

                    </div>
                    <div>
                        <button @click="doneImg" type="button" class="neon-button">DONE !</button>
                    </div>
                </div>
            </div>
        <form class="form" >
            <h2>REGISTRATION</h2>
            <label class="border" for="img">
                <input type="file" @change="getImg" name="img" id="reg">
            </label>
            



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
            <button @click.prevent="store" type="submit" class="neon-button">SUBMIT</button>
        <div v-if="error" class="text-danger">{{ error }}</div>
        </form>



    </section>
</template>
<script>

import Crop from './Crop.vue'


export default {
    data() {
        return {
            image: null,
            image_croped: null,
            name: "",
            email: "",
            password: "",
            password_confirmation: null,
            error: null,
            done: false,


            img_preview: null,
            cropper: {},
            destination: {}
        }
    },


    watch: {
        // image: function (value) {
        //         this.canvas()
        //     },

    },

    mounted() {

    },

    components: {
        Crop,
    },
    methods: {

        change({ coordinates, canvas }) {
			console.log(coordinates, canvas)
		},

        dest(val){
            console.log(val)
            this.destination = val
        },

        getImg(e){
            this.image = e.target.files[0]
            const fileReader = new FileReader();
            fileReader.readAsDataURL(e.target.files[0]);
            var _this = this

            fileReader.onload = function (e) {


                _this.img_preview = this.result
                // async () => {
                //     CreateComponentPublicInstance.img_preview = await this.result
                // }
            }

        },

        doneImg(){
            const _this = this;
            const url = this.destination;
            fetch(url)
              .then(res => res.blob())
              .then(blob => {
                const file = new File([blob], "File name",{ type: "image/png" })
                console.log(file)
                _this.image_croped = file
                console.log(_this.image_croped)

              })

              this.done = !this.done


        },

        store() {
            console.log(this.image)
            let data=new FormData
            data.append('img',this.image)
            data.append('img_croped',this.image_croped)
            data.append('name', this.name)
            data.append('email', this.email)
            data.append('password',this.password)
            data.append('password_confirmation', this.password_confirmation)


            axios.post('/api/users', data ).then( res => {
                console.log('res');
                console.log(res)
                localStorage.setItem('access_token' , res.data.access_token)
                this.$router.push({ name: 'user.personal'})
            }).catch( error => {
                console.log('error');
                console.log(error.response);
                this.error = error.response.data.message
            })
        }
    },
}
</script>
<style lang="scss" scoped>

.border{
    input[type="file"]{
        max-width: 100%;
    }
}
.overlaping-div{
    position: fixed;
    top: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.652);
    backdrop-filter: blur(5px);
    z-index: 2;
    display: flex;
}
.o-d-f-c{
    margin: auto auto;
    width: 50%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    align-items: center;

}

.o-d-f-item{
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    div{
        max-width: 45%;
        img{
            max-width: 45%;
        }
    }
    img{
        max-width: 45%;
        width: auto;
        height: auto;
        aspect-ratio: 1 / 1;
    }
}
.crop-label {
	max-width: 60%;
    width: fit-content;
	

}
.float-img{
    width: auto;
    height: auto;
    flex-basis: 28%;
}

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

    .register{
        width: 100%;
        height: 80vh;
        display: flex

    }

    .form{
        background: rgba(147, 147, 147, 0.115);
        backdrop-filter: blur(10px);
        padding: 1.5vw 1vw;
        border-radius: 5px;
        box-sizing: border-box;
        margin: auto auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        width: 25%;
        height: 80%;

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
        

    }

    @media screen and (max-width: 1200px) {
        .form{
            width: 50%;
            padding: 3vw 2vw;
        }
    }

    @media screen and (max-width: 1000px) {
        .o-d-f-c{
            gap: 3.4vw;
        }
        .o-d-f-item{

            flex-direction: column;
            justify-content: space-around;
            height: 78vh;
            img{
                max-width: 50%;
            }
        }
        .crop-label{
            max-width: 100%;
        }
    }

    @media screen and (max-width: 800px) {
    .o-d-f-item{
        img{
            max-width: 60%;
        }
    }
    
    }

    @media screen and (max-width: 600px) {

        .o-d-f-item{
            img{
                max-width: 75%;
            }
        }
        .form{
            width: 80%;
            padding: 5.5vw 2vw;
        }
    }

    @media screen and (max-width: 450px) {
        .o-d-f-item{
            img{
                max-width: 85%;
            }
        }

    }

    @media screen and (max-width: 400px) {
        .o-d-f-item{
            img{
                max-width: 100%;
            }
        }

        .o-d-f-c{
            gap:7vw
        }

    }


</style>


