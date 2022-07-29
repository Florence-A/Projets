const express = require('express')
const routerP = express.Router()
// const mongoose = require('mongoose')
// const db = require('../db/connection.js');
const Product = require('../models/product.js')


routerP.get('/products/list', (req,res)=>
{
    Product.find()
    .then((products)=>{
            res.json(products); 
        })
        
})

module.exports = routerP;

// gros bug, refusais d'aller chercher produits
// .catch(err=>console.err ne lui plaisait pas)
// Nvlle erreur qui empeche pas de tourner : 
// Error [ERR_HTTP_HEADERS_SENT]: Cannot set headers after they are sent to the client > qd il ya plusieurs
// plusieurs res.send/json etc dans une fonction
