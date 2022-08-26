<?php
require ('config.php');
require('Database.php');
require('helpers.php');
require('controller.php');
require('model.php');
require('App.php');

/*
* load clases
*/
spl_autoload_register(function($class_name){
    require (ROOT."/private/models/". $class_name . ".php");
});