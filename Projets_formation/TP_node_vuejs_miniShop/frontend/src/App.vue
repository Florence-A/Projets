<template>
  <div>

    <img alt="Vue logo" src="./assets/logo.png">

    <WelcomeMsg></WelcomeMsg>

    <hr><div class="menu">
      
      <router-link to="/ProductsList"> Produits </router-link>
      <router-link to="/LogIn"> Connexion </router-link>
      <router-link to="/SubScribe"> Inscription </router-link>
      <a href="" id="deconnexion"> Déconnexion </a>
      
    </div><hr>

    <div>
      <router-view/><hr>
    </div>

    <div>
      nom :  {{ $store.state.nom }}<br>
      prenom :  {{ $store.state.prenom }}<br>
      age :  {{ $store.state.age }}
      {{ $store.getters.affiche }}

      <br>
      <button @click="plusplus" class="btn btn-success">+ 1</button><br>
      <button @click="plusx(5)" class="btn btn-danger">+ 5</button><br>
      <button @click="actplus(11)" class="btn">+ 11 + 1</button>

    </div>
  </div>
</template>

<script>

import WelcomeMsg from './components/WelcomeMsg.vue'

export default {
  name: 'App',
  methods: {
    plusplus(){
      //this.$store execute directement une mutation
      this.$store.commit('AJOUTE_UN_AN')
    },
    plusx(x){
      this.$store.commit('AJOUTE_X',x)
    },
    actplus(x){
      this.$store.dispatch('updateAge',x)
    }
  },
  components:{
    WelcomeMsg,
  }
}



window.onload=()=>{

//------ Deconnexion ------
  document.getElementById("deconnexion").addEventListener("click",()=>{
    window.localStorage.removeItem('token')
  })

}




</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.menu {
  display : flex;
  justify-content: space-around;
  margin-top : 40px;
  margin-bottom : 40px;
}
</style>
