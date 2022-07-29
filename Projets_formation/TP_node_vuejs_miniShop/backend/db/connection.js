const mongoose = require('mongoose')

var db = mongoose.connect('mongodb://localhost:27017/shop', {useNewURLParser:true})
.then(()=>{console.log("Connexion OK")}, err =>{console.log(err)})