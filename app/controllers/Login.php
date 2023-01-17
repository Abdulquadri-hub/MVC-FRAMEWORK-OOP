<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* LOGIN
*/

class Login 
{

    use MainController;

    public function index($id = null){

        $errors = [];

        $user = new User();

        if (Request::posted()) 
        {
            if(!empty($_POST['email']))
            {
                if($row = $user->first('email', $_POST['email']))
                {
                        if (password_verify($_POST['password'], $row->password)) 
                        {
                            Session::auth($row);
                            $this->redirect("/home");
                        }
                    
                }
            }
            $errors['email'] = "Wrong email or password";
        }

        $this->view("auth/login",[
            'errors'=>$errors,
        ]);
}

}