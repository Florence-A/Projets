const express = require('express')
const mongoose = require('mongoose')
const Product = require('./models/product')

mongoose.connect('mongodb+srv://flo-:Uu6ACSWs5Xm4UqK@cluster0.sehymtm.mongodb.net/?retryWrites=true&w=majority',
    { useNewUrlParser : true,
      useUnifiedTopology : true})
    .then( ()=>console.log("Connexion réussie :)"))
    .catch( ()=>console.log("C'est raté :/"))


const app = express()
app.use((req, res, next) => {
    res.setHeader('Access-Control-Allow-Origin','*');
    res.setHeader('Access-Control-Allow-Headers','Origin, X-Requested-With, Content, Accept, Content-Type, Authorization');
    res.setHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, PATCH, OPTIONS');
    next();
  });

  app.use(express.json())



/////////////// ROUTES ////////////////

app.post('/api/products',(req,res,next)=>{
    const product = new Product({
        ...req.body
    })
    product.save()
        .then( () => res.status(201).json({product}))
        .catch( error => console.error(`Erreur :${error.code} => ${error.message}`))

})

app.get('/api/products',(req,res,next)=>{
    Product.find()
        .then( products => res.status(200).json({products}))
        .catch( res.status(400))
})

app.get('/api/products/:id',(req,res,next)=>{
    Product.findOne({_id:req.params.id})
        .then( product => res.status(200).json({product}))
        .catch ( res.status(400))
})

app.put('/api/products/:id', (req,res,next)=>{
    Product.updateOne({_id:req.params.id},{...req.body,_id:req.params.id})
        .then(()=> res.status(200).json({message:"Modified !"}))
        .catch(res.status(400))
})

app.delete('/api/products/:id', (req,res,next)=>{
    Product.deleteOne({_id:req.params.id})
        .then( res.status(200).json({message:"Deleted !"}))
        .catch( error => console.error(`Erreur : ${error.code} => ${error.message}`))
})


///////////////////////////////////////

module.exports = app