<template>

<div>
    <h1>Connexion</h1><br>
    <h3>{{ msg }}</h3>
    <input v-model="email" type="text" placeholder="Adresse mail"><br><br>
    <input v-model="mdp" type="password" placeholder="Mot de passe"><br><br>
    <button @click="action(m,p)">Se connecter</button>
</div>

</template>


<script>

    import axios from 'axios'

    export default 
    {
        name: "LogIn",
        data(){
            return{
                email:"",
                mdp:"",
                msg:""
            }
        },
        methods:{
            action(m,p){
                m = this.email
                p = this.mdp
                axios.post('http://localhost:9000/user/login',{mail:m,password:p})
                .then((res)=>{

                    if (res.data.token !== "erreur"){
                        localStorage.setItem('token',res.data.token)
                        location.reload()
                    }
                    else {
                        this.msg = "Mot de passe incorrect"
                    }
                    
                    
                })
            }
        }
    }


</script>


<style></style>