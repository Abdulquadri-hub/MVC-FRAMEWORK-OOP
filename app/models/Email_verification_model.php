<?php

defined('ROOTPATH') OR exit('Access Denied!');

/*
*  Email Verification MODEL CLASS
*/


class Email_verification_model {

    public $table = "email_verifications";

    use Model;

    protected $allowedColumns = [
        'code',
        'email',
        'expires',
        'date'
    ];


    # VALIDATE DATA
    public function validate($DATA)
    {
        $this->errors = [];

        if (empty($DATA['code']) && !is_int($DATA['code'])) {
            
            $this->errors['code'] = "Please enter a valid code";
        }

        if (count($this->errors) == 0) 
        {
            return true;
        }

        return false;
    }

    /** CHECK IF EMAIL IS VERIFIED */
    public function Check_if_verified():bool
    {

        $arr = [];
        $query = "select * from users where id = :id limit 1";
        $arr['id'] = Session::user('id');
        $row = $this->query($query,$arr);

        if(is_array($row)){
            $row = $row[0];
            if($row->email == $row->verified_email)
            {
                return true;
            }
        }

        return false;
    }
    
}