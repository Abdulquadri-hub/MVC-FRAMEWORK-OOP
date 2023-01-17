<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* PROFILE 
*/

class Profile 
{
    use MainController;
    
    public function index($id = "")
    {

        if (!Session::is_logged_in()) 
        {
            $this->redirect("login");
        }

        $user = new User();

        $row = $user->first("user_id", $id);

        $this->view("profile",['row'=>$row]);
    }
}
