<?php

defined('ROOTPATH') or exit("Access Denied");

/*
* Email_verification Controller
*/

class Email_verification 
{
    use MainController;

    public function index($id = null)
    {
        
        if (!Session::is_logged_in()) 
        {
            $this->redirect("login");
        }

        $errors = [];

        $e_verify = new Email_verification_model();
        $mail = new Mail();

        if (Request::method() == "GET" && !$e_verify->Check_if_verified()) 
        {
            $VARS = [];
            $VARS['code'] = rand(10000,99999);
            $VARS['expires'] = time() + (60 * 1);
            $VARS['email'] = Session::getemail('email');
            $VARS['date'] = date('Y-m-d-H:i:s');

            $message = "<h3>Your code is : </h3>" . $VARS['code'];
            $subject = "Email verification";
            $recipient = $VARS['email'];

            $mail->send_email($recipient,$subject,$message);
            $e_verify->insert($VARS);
        }


        if(Request::posted())
        {
            if($e_verify->validate($_POST)) {

                if(!$e_verify->Check_if_verified())
                {
                    $query = "select * from email_verifications where code = :code && email = :email";
                    $VARS = [];
                    $VARS['email'] = Session::user('email');
                    $VARS['code'] =  Request::post('code');
    
                    $rows = $e_verify->query($query,$VARS);
    
                    if(is_array($rows))
                    {
                        $row = $rows[0];
                        $current_time = time();

                        if($row->expires > $current_time)
                        {
                            $arr = [];
                            $query = "update users set verified_email = :verified_email where id = :id limit 1";
                            $arr['id'] = Session::user('id');
                            $arr['verified_email'] = $row->email;
                            $e_verify->query($query,$arr);

                            $this->redirect('profile');

                        }else {
                            $errors['code'] = "Code expired !!";
                        }
                    }
    
                }else {
                    message("You are verified");
                }
            }else {
                
                $errors = $e_verify->errors;
            }
        }

        $this->view("auth/email_verification",[
            'errors'=>$errors,
        ]);
    }
}
