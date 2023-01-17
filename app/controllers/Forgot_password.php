<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* Forgot_password
*/

class Forgot_password 
{
    use MainController;

    public function index($id = null)
    {

        $errors = [];

        $p_forgot = new Forgot_password_model();

        $mode =  $mode ?? "";

        $this->view("auth/forgot_password",[
            'errors'=>$errors,
            'mode'=>$mode
        ]);
    }

    public function email()
    {
        $errors = [];

        $p_forgot = new Forgot_password_model();

        $mode =  "email";
        
        if (Request::posted()) 
        {
            if($p_forgot->validate($_POST))
            {
                $email = $_POST['email'];
                Session::set('email',$email);
                $p_forgot->send_email($email);

                $this->redirect('forgot_password/code');
            }else{
                $errors = $p_forgot->errors;
            }
        }
        

        $this->view("auth/forgot_password",[
            'errors'=>$errors,
            'mode'=>$mode
        ]);
    }

    public function code()
    {
        $errors = [];

        $p_forgot = new Forgot_password_model();

        $mode =  "code";
        
        if (Request::posted()) 
        {
            if($p_forgot->validate($_POST))
            {
                $code = $_POST['code'];
                $p_forgot->valid_code($code);

                Session::set('code',$code);

                $this->redirect('forgot_password/password');
            }else{
                $errors = $p_forgot->errors;
            }
        }
        
            $this->view("auth/forgot_password",[
                'errors'=>$errors,
                'mode'=>$mode
            ]);
    }

    public function password()
    {
        $errors = [];

        $p_forgot = new Forgot_password_model();

        $mode =  "password";
        
        if (Request::posted()) 
        {
            if($p_forgot->validate($_POST))
            {
                $password = $_POST['password'];
                $p_forgot->save_password($password);

                Session::pop('email');
                Session::pop('code');
                
                $this->redirect('login');
            }else{
                $errors = $p_forgot->errors;
            }
        }
        

        $this->view("auth/forgot_password",[
            'errors'=>$errors,
            'mode'=>$mode
        ]);
    }
}
