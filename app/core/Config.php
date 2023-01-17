<?php

defined('ROOTPATH') OR exit('Access Denied!');

# ROOT PATH
define("ROOT_PATH", "C:/xampp/htdocs/OOP-MVC-FRAMEWORK");


# ROOT URL && DATABASE CONNECTION CONTRAINT
if($_SERVER['SERVER_NAME'] == "localhost"){

    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "mvc");
    define("DBDRIVER", "mysql");

    define("ROOT_URL", "http://localhost/OOP-MVC-FRAMEWORK/public".DIRECTORY_SEPARATOR);
}else{

    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    define("DBNAME", "mvc");
    define("DBDRIVER", "mysql");

    define("ROOT_URL", "https://my_website.com".DIRECTORY_SEPARATOR);
}

# DEBUG CONST
define('DEBUG', true);

# APP CONST
define('APP', 'DEMO_APP');
define('DESC', 'This is a demo description of the app');


