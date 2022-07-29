const express = require('express');
const dotenv = require('dotenv')
require('./db/connection.js');
const routerP = require('./routers/product.js');
const routerU = require('./routers/user.js')
const cors = require('cors')


const app = express()
dotenv.config()
const port = 9000


app.use(cors())
app.use(express.json())
app.use(express.urlencoded({extended:true}))


app.use(routerU)
app.use(routerP)


app.listen(port,()=>{
    console.log(`Listen on ${port}`)
})

// il y a qqchose qui bloque tout, la connexion est établie et après les routes ne fonctionnent pas
// il ne trouve pas les routes ?
// > quand je dégage app.use(cors) ça marche... > il fallait écrire app.use(cors()) haha...
// Ma route sign up c'est ok

// Ma route login ne fonctionne pas tt a fait : juste le console.log, ne renvoit rien et tourne 
// ds le vide : pourtant le User.findOne({mail:req.body.mail}) fonctionne sur le signup
// en remettant cors() ça fonctionne mais on a un autre mess "could not send request" ds postman