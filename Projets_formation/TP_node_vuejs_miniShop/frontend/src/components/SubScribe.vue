<template>

<div>
    <h1>Inscription</h1><br>
    <input v-model="prenom" type=text placeholder="Prénom"><br><br>
    <input v-model="nom" type=text placeholder="Nom"><br><br>
    <input v-model="email" type="text" placeholder="Adresse mail"><br><br>
    <input v-model="mdp" type="password" placeholder="Mot de passe"><br><br>
    <button @click="action(n,pr,m,p)">S'inscrire'</button>
</div>

</template>


<script>

    import axios from 'axios'

    export default 
    {
        name: "SubScribe",
        data(){
            return{
                nom:"",
                prenom:"",
                email:"",
                mdp:""
            }
        },
        methods:{
            action(n,pr,m,p){
                n = this.nom
                pr = this.prenom
                m = this.email
                p = this.mdp
                axios.post('http://localhost:9000/user/signup',{firstname:pr,lastname:n,mail:m,password:p})
                console.log('ok')
            }
        }
        
    }


</script>


<style></style>