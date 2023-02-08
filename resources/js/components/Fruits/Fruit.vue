<template lang="">
    <section class="fruit-sec">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="fruit in fruits">
                    <th scope="row">{{ fruit.id }}</th>
                    <td>{{ fruit.name }}</td>
                    <td>{{ fruit.price }}</td>
                </tr>
            </tbody>
        </table>
    </section>
</template>
<script>
import API from '../../api'

export default {
    name: 'Fruit',
    data() {
        return {
            fruits: null
        }
    },
    mounted() {
        this.getFruits()
    },
    methods: {
        getFruits() {
            API.get('/api/fruits')
            .then( res => {
                this.fruits = res.data.data
            })
        }
    },
}
</script>
<style lang="scss" scoped>
.fruit-sec{
    width: 100%;
    height: 90vh;
    display: flex;
}
.table{
    margin: auto auto;
    background: rgba(255, 255, 255, 0.211);
    backdrop-filter: blur(10px);
    border-collapse: collapse;
    border: none;
    color: rgb(198, 198, 198);
    width: 50%;
    thead{
        background: rgb(55, 4, 55);
        color: rgb(191, 191, 191);
    }
    td,tr{
        border: 1px solid rgb(43, 43, 43);
    }
}
    
@media screen and (max-width: 500px) {
    .table{
        width: 80%;
    }   
}

</style>