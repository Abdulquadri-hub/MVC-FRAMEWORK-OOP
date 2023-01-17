<?php

defined('ROOTPATH') OR exit('Access Denied!');

/*
*  Forgot_password MODEL CLASS
*/


class Forgot_password_model {

    public $table = "forgot_passwords";

    use Model;

    protected $allowedColumns = ['email','code','expires','date'];


    # VALIDATE DATA
    public function validate($DATA)
    {
        $this->errors = [];

        if(isset($DATA['email']))
        {
            if (empty($DATA['email']) && !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
                
                $this->errors['email'] = "Please enter a valid email";
            }

            elseif (!$this->valid_email($DATA['email'])) {
                
                $this->errors['email'] = "Email is not valid";
            }
        }

        if(isset($DATA['code']))
        {
            if (empty($DATA['code'])) {
                
                $this->errors['code'] = "Code is required";
            }

            elseif(!$this->valid_code($DATA['code']))
            {
                $this->errors['code'] = "Code has expired!!";
            }
        }

        if(isset($DATA['password']))
        {
            if (empty($DATA['password'])) {
                
                $this->errors['password'] = "Please enter a valid New password";
            }
            
            elseif (strlen($DATA['password'] <= 8)) {
            
                $this->errors['password'] = "New password must be at leasts 8 characters";
            }

        }

        if (count($this->errors) == 0)
        {
            return true;
        }

            return false;
    }

    public function valid_email($email):bool
    {
        $user = new User();

        if(!empty($email))
        {
            if($user->first('email',$email))
            {
                return true;
            }
        }

        return false;
    }

    public function send_email($email) {

        $mail = new Mail();
        if(isset($email))
        {
            
            if($this->valid_email($email))
            {
                $VARS['code'] = rand(10000,99999);
                $VARS['email'] = $email;
                $VARS['expires'] = time() + (60 * 1);
                $VARS['date'] = date('Y-m-d-H:i:s');

                $message = "<h3>Your code is : </h3>" . $VARS['code'];
                $subject = "Reset Password";
                $recipient = $VARS['email'];
    
                $mail->send_email($recipient,$subject,$message);
                $this->insert($VARS);
            }
        }
        return false;
    }

    public function valid_code($code)
    {
        if(!empty($code))
        {
            $VARS = [];
            $VARS['code'] = $code;
            $VARS['email'] = Session::get('email');
            $current_time = time();
            $query = "select * from forgot_passwords where code = :code && email = :email limit 1";
            $data = $this->query($query,$VARS);

            if(is_array($data))
            {
                $data = $data[0];
                if($data->expires > $current_time)
                {
                    return true;
                }
            }
        }

        return false;
    }



    public function save_password($password)
    {
        $code = Session::get('code');
        if($this->valid_code($code))
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "update users set password = :password where email = :email limit 1";
            return $this->query($query,['password'=>$password, 'email'=>Session::get('email')]);
        }
        return false;
    }
}