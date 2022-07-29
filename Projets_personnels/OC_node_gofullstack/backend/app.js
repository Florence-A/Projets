const express = require('express');
const mongoose = require('mongoose');

const app = express();

const stuffRoutes = require('./routes/stuff');



mongoose.connect('mongodb+srv://flo-:Uu6ACSWs5Xm4UqK@cluster0.sehymtm.mongodb.net/?retryWrites=true&w=majority',
    { useNewUrlParser : true,
    useUnifiedTopology : true })
    .then( () => console.log('Connexion à MongoDB réussie :)'))
    .catch( error => { console.error(`MongoDB fail connection with: ${error.code} => ${error.message}`)});

app.use(express.json())

// Résoud les problèmes CORS - middleware sans adresse qui s'appliquera à ttes les routes
app.use((req,res,next)=>{
    res.setHeader('Access-Control-Allow-Origin','*');
    res.setHeader('Access-Control-Allow-Headers','Origin, X-Requested-With, Content, Accept, Content-Type, Authorization');
    res.setHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, PATCH, OPTIONS');
    next();
});

app.use('/api/stuff',stuffRoutes);




module.exports = app;