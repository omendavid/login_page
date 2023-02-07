<template lang="">
    <section class="personal-sec">
        <div class="pers-cont">
            <h2>PERSONAL</h2>
        </div> 
    </section>
</template>
<script>
export default {
    name: 'Personal'
    
}
</script>
<style lang="scss" scoped>
    .personal-sec{
        width: 100vw;
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
    }
</style>