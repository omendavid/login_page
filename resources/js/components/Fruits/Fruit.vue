<template lang="">
    <div>
        <table class="table w-50">
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
    </div>
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
<style lang="">
    
</style>