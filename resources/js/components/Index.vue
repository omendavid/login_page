<template lang="">
    <div>
        <router-link :to="{ name: 'fruit.index' }">List</router-link>
        <br>
        <router-link :to="{ name: 'users.registration' }">Registration</router-link>
        <br>
        <router-link :to="{ name: 'user.login' }">Login</router-link>
        <br>
        <router-link :to="{ name: 'user.personal' }">Personal</router-link>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    name: 'Index',
    
}
</script>
<style lang="" scoped>
    
</style>