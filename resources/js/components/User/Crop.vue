<template lang="">
    <div class="crop">
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
            zoomable: true,
            scalable: false,
            aspectRatio: 1,
            viewMode: 1,
            responsive: true,

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
.crop{
    max-width: 45%;
    max-height: 46vh;
}
.cropper-image {
  max-width: 100%;
  height: auto;
}

</style>
