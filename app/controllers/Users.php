<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* USER
*/

class Users 
{
    use MainController;
    
    public function index($id = null)
    {

        if (!Session::is_logged_in()) 
        {
            $this->redirect("login");
        }

        $user = new User();

        $data = $user->findAll();

        $this->view("users",['rows'=>$data]);
    }
}
