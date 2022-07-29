<template>
    <div class="container">
        <div class="card" v-for='product in products' v-bind:key="product">
            <img :src="require('../assets/images/'+product.img)" class="card-img-top" :alt="'photo de '+product.name" >
            <div class="card-body">
                <h1>{{ product.name }}</h1>
                <p>{{ product.description }}</p>
                <p>{{ product.price }}</p>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default 
{
    name: "ProductsList",
    data(){
        return{
            products: {}
        }
    },
    mounted(){
        axios.get('http://localhost:9000/products/list')
        .then((response)=>{
            this.products = response.data
            console.log(response)
        })
    }
}
</script>

<style>
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;

}
.card {
    width: 300px;
    margin: 15px; 
}
</style>