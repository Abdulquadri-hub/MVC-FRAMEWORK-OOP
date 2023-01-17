<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* HOME
*/

class Home 
{
    use MainController;

    public function index($id = null)
    {
        
        if (!Session::is_logged_in()) 
        {
            $this->redirect("login");
        }

        $user = new User();

        $data['rows'] = $user->findAll();

        $this->view("home",$data);
    }
}
