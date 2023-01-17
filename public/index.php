<?php
session_start();

# VALID PHP VERSION EXTENSION  
$minPhpVersion = "8.0";

if(phpversion() < $minPhpVersion){

    die("Your php version must be {$minPhpVersion} or higher to run this app. Your current version is ". phpversion());
}

# GET THE PATH OF THE DIRECTORY
define('ROOTPATH', __DIR__ . DIRECTORY_SEPARATOR);

# AUTOLOAD
include("../app/core/autoload.php");

# SHOW ERRORS
DEBUG ? ini_set('display_errors',1) : ini_set('display_errors',0);

# APP 
$app = new App();

//Session::flush();
show($_SESSION);