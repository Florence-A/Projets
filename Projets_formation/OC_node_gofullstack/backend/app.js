const express = require('express');
const mongoose = require('mongoose');
const Thing = require('./models/thing')

const app = express();


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


app.post('/api/stuff',(req,res,next)=>{
    delete req.body._id;
    const thing = new Thing({
        ...req.body
    }); // Spread ... fait une copie de tous les éléments de la req.body
    thing.save()
        .then( ()=> res.status(201).json({ message : 'Objet enregistré :)'}))
        .catch( error => { console.error(`Erreur ${error.code} => ${error.message} `)});
});

app.get('/api/stuff/:id', (req,res,next) => {
    Thing.findOne({_id:req.params.id})
        .then (thing => res.status(200).json(thing))
        .catch (error => console.error(`Erreur : ${error.code} => ${error.message}`));
})

app.put('/api/stuff/:id', (req,res,next)=>{
    Thing.updateOne({_id:req.params.id},{...req.body, _id:req.params.id})
        .then( ()=> res.status(200).json({message:"Objet modifié :)"}))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`))
})

app.delete('/api/stuff/:id', (req,res,next)=>{
    Thing.deleteOne({_id:req.params.id})
        .then( res.status(200).json({message:"Objet supprimé avec succès"}))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`))
})

app.get('/api/stuff', (req,res,next) => {
    Thing.find() // grâce à la méthode find mongoose renvoit un tableau contenant tous les Thing
        .then(things => res.status(200).json(things))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`));
});


module.exports = app;