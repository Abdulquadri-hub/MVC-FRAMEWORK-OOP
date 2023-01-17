<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* LOGOUT
*/

class Logout  
{
    use MainController;
    
    function index($id = null)
    {
        Session::logout();
        $this->redirect("login");
    }
}
