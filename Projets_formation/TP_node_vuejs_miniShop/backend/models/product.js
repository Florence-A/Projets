const mongoose = require('mongoose')

var Schema = mongoose.Schema

var ProductSchema = new Schema({
    name: {
        type: String,
        required: true
    },
    description: {
        type: String
    },
    price: {
        type: Number
    },
    img: {
        type: String
    }
})

var Product = mongoose.model("Product",ProductSchema)

module.exports = Product