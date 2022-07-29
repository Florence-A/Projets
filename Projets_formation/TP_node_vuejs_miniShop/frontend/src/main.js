import 'bootstrap/dist/css/bootstrap.min.css'
import { createApp } from 'vue'
import { createStore } from 'vuex'
import App from './App.vue'
import router from './router'

// var token = localStorage.getItem('token')
// console.log(token)

// if (token && typeof token === 'string') {
    
//     var payload = token.split('.')[1]
//     var user = JSON.parse(window.atob(payload))
// }


const store = createStore({
    state (){
        return{
            nom: "Dupont",
            prenom: "Fred",
            age: 35,
            // lastname: `${user.nom}`,
            // firstname: `${user.prenom}`,
        }
    },
    // le state correspond aux datas de ts ls composants
    // ds n'importe quel template on devrait pouvoir acceder à ces infos
    getters:{
        affiche: (state)=>{
            return `${state.nom} ${state.prenom} age de ${state.age}`
        }
    },
    mutations: {
        AJOUTE_UN_AN(state){
            state.age++
        },
        AJOUTE_X(state,payload){
            state.age += payload
        }
    },
    actions:{
        updateAge(context,x){
            context.commit('AJOUTE_UN_AN')
            context.commit('AJOUTE_X',x)
        }
    }
})

createApp(App).use(router).use(store).mount('#app')
