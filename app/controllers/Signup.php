<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* SIGNUP  
*/

class Signup 
{
    use MainController;

    public function index($id = null)
    {
        $errors = [];

        $user = new User();

        if (Request::posted()) 
        {
            if ($user->validate($_POST)) 
            {
                $user->insert($_POST);
                $this->redirect("login");
            }else {
                $errors = $user->errors;
            }
        }

        $this->view("auth/signup",[
            'errors'=>$errors
        ]);
    }
}
