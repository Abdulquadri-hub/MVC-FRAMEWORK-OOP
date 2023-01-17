<?php

defined('ROOTPATH') OR exit('Access Denied!');

/*
*  MAIN CONTROLLER
*/


Trait MainController {

    # VIEW
    public function view($view,$data = array()){
        extract($data);

        if(file_exists(ROOT_PATH."/app/views/".$view. ".view.php"))
        {
            require(ROOT_PATH."/app/views/".$view. ".view.php");
        }else{
            require(ROOT_PATH."/app/views/404.view.php");
        }
    }

    # LOAD MODEL
    public function load_model($model){
        if (file_exists(ROOT_PATH."/app/models/".ucfirst($model).".php")) {
            require(ROOT_PATH."/app/models/".ucfirst($model).".php");
            return $model = new $model();
        }
        return false;
    }

    # REDIRECT
    public function redirect($redirect){
        header("Location: ".ROOT_URL. trim($redirect, "/"));
        die;
    }

}
