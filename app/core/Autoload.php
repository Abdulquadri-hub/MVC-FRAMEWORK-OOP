<?php

defined('ROOTPATH') OR exit('Access Denied!');

require ('config.php');
require('Database.php');
require('Session.php');
require('Request.php');
require('functions.php');
require('MainController.php');
require('Model.php');
require('App.php');


spl_autoload_register(function($class_name){
    require (ROOT_PATH."/app/models/". $class_name . ".php");
});