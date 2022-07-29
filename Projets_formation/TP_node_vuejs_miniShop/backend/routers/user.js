const express = require('express')
const cors = require('cors')
const jwt = require('jsonwebtoken')
const bcrypt = require('bcryptjs')
const mongoose = require('mongoose')
require('../models/user.js')
const routerU = express.Router()
var User = mongoose.model('User');



//----------------------------- Generation du TOKEN ------
// en lisant la clé privé sous .env 
// la clé est créée par =>require('crypto').randomBytes(64).toString('hex')
// sous le shell node.
// créer un fihier .env et ajouter TOKEN_SECRET = le Token
//--------------------------------------------------------
function generateAccessToken(user) {
    // expire apres 50 minutes
    console.log(user)
    return jwt.sign({nom:user.lastname, prenom:user.firstname}, process.env.TOKEN_SECRET, { expiresIn: '50m' });
}
  /*
  exiresIn options 
  '2 days'  // 172800000
  '1d'      // 86400000
  '10h'     // 36000000
  '2.5 hrs' // 9000000
  '2h'      // 7200000
  '1m'      // 60000
  '5s'      // 5000
  '1y'      // 31557600000
  '100'     // 100
  */

  //-------------------middleware de verification ------
function authenticateToken(req, res, next) {
    // const token = req.headers['x-access-token']
    console.log(req.headers);
    // pour postman ça renvoit
    // Bearer a20cc76b28acc745d95e12136c0231e84cd9261cb507bee42fb7239322adaf64bd8b272b1c98c00
//c8944d5d4d56d7afd4f36bb2653637583ff93663f4bc3c028
    const token = req.headers.authorization.split(" ")[1]
    // const token = req.headers.authorization
    console.log("TOKEN",token);
    if (token == null) { 
        return res.sendStatus(401) 
    } // if there isn't any token
    jwt.verify(token, process.env.TOKEN_SECRET, (err, user) => {
        if (err) return res.sendStatus(403)
        req.user = user
        next() 
    })
}


routerU.post('/user/signup',(req,res) => 
{
    console.log(req.body);
    User.findOne({ mail: req.body.mail })
    .exec((err,user) => {
        if(err){
            res.status(500).send({message: err});
        }
        if(user){
            res.status(400).send({message: "Email déjà utilisé !"})
        } else {
            var salt = bcrypt.genSaltSync(10)
            var hash = bcrypt.hashSync(req.body.password, salt)

            var user = new User({
                firstname: req.body.firstname,
                lastname: req.body.lastname,
                mail: req.body.mail,
                password: hash
            })

            user.save((err)=>{
                if (err) { return handleError(err); }
                else { res.status(200).send(user); } 
                
            })
        }
    })
})


routerU.post('/user/login', (req,res) => 
{
    // console.log(req.body);
    User.findOne({ mail: req.body.mail })

    .exec((err, user) => {
        if (err) { res.status(500).send({ message: err }); }

        if (!user) {
        console.log("no user")
        return res.status(404).send({ message: "User Not found." });
        }
    

        if (user) {

            const isValidPass = bcrypt.compareSync(req.body.password,user.password)

            if (isValidPass) {
                const token = generateAccessToken(user)
                // console.log(token)
                res.status(200).send({token:token});
            }
            else { res.send({token: "erreur"})}
        }
        
    
    })
})


routerU.get('/api/orders', authenticateToken , function(req, res) {
    console.log("OK TU PASSES!!");
      res.send('ok');
})


module.exports = routerU