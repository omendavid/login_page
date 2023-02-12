<template lang="">
    <div>
        <img :src="img_preview" ref="image">
    </div>
</template>
<script>
import  Cropper  from 'cropperjs';



export default {
    name: 'Crop',
    data() {
        return {

            cropper: {},
            destination: {}
        }
    },
    props: {
        img_preview:{
            type: String
        }
    },
    components: {
        Cropper
    },
    mounted() {

        this.cropper = new Cropper(this.$refs.image, {
            zoomable: false,
            scalable: false,
            aspectRatio: 1,

            crop: () => {
                const canvas = this.cropper.getCroppedCanvas();
                this.destination = canvas.toDataURL('image/png')
                this.$emit('destinationChange', this.destination)
            }
        })
    },
    methods: {

        change({ coordinates, canvas }) {
			console.log(coordinates, canvas)
		},


    },
}
</script>
<style lang="scss">
.cropper-container{
    max-width: 100%;
    max-height: 50vh;
}

.cropper-crop-box{
    transform: translate(auto,auto) !important;
}
</style>
