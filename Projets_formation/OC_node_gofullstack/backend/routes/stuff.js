const express = require('express');
const router = express.Router();

const Thing = require('../models/thing')


router.post('/',(req,res,next)=>{
    delete req.body._id;
    const thing = new Thing({
        ...req.body
    }); // Spread ... fait une copie de tous les éléments de la req.body
    thing.save()
        .then( ()=> res.status(201).json({ message : 'Objet enregistré :)'}))
        .catch( error => { console.error(`Erreur ${error.code} => ${error.message} `)});
});

router.get('/:id', (req,res,next) => {
    Thing.findOne({_id:req.params.id})
        .then (thing => res.status(200).json(thing))
        .catch (error => console.error(`Erreur : ${error.code} => ${error.message}`));
})

router.put('/:id', (req,res,next)=>{
    Thing.updateOne({_id:req.params.id},{...req.body, _id:req.params.id})
        .then( ()=> res.status(200).json({message:"Objet modifié :)"}))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`))
})

router.delete('/:id', (req,res,next)=>{
    Thing.deleteOne({_id:req.params.id})
        .then( res.status(200).json({message:"Objet supprimé avec succès"}))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`))
})

router.get('/'+'', (req,res,next) => {
    Thing.find() // grâce à la méthode find mongoose renvoit un tableau contenant tous les Thing
        .then(things => res.status(200).json(things))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`));
});


module.exports = router;