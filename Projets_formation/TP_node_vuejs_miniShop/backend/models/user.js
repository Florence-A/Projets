const mongoose = require('mongoose')

var Schema = mongoose.Schema

var UserSchema = new Schema({
    firstname: {
        type: String,
        required: true
    },
    lastname: {
        type: String
    },
    mail: {
        type: String,
        required : true
    },
    password: {
        type: String,
        required: true
    }
})

mongoose.model("User",UserSchema)

