<template>
    <div>
        {{ msg }}
    </div>
</template>

<script>




export default
{
    
    name: 'WelcomeMsg',
    data(){
        return{
            msg: ""
        }
    },
    mounted()
    {
            if (localStorage.token && typeof localStorage.token !== Object){
                var payload = localStorage.getItem('token').split(".")[1]
                var user = JSON.parse(window.atob(payload))
                this.msg = `Bonjour ${user.prenom} !`
            }
            else if (typeof localStorage.token !== String){
                this.msg = "Non connecté"
            }
    }
}

    
</script>

<style scoped>
div{
    margin : auto;
    color : grey;
    width : 200px;
    font-size : 18px;
    font-style: italic;
}
</style>
