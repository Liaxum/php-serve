// Place this file next to a folder named "public"
// "public" should contain your php website. Like Opencart or Wordpress.
var express = require('express');
var php = require("node-php"); 
var path = require("path"); 

var app = express();

app.use("/php", php.cgi("public")); 

app.listen(8545);

console.log("Server listening!"); 