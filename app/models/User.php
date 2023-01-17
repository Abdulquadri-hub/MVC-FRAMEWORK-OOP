<?php

defined('ROOTPATH') OR exit('Access Denied!');

/*
*  USER MODEL CLASS
*/


class User {

    use Model;

    protected $beforeInsert = ['make_user_id','hash_password'];

    protected $allowedColumns = ['username','email', 'password', 'date'];


    # VALIDATE DATA
    public function validate($DATA)
    {
        $this->errors = [];

        if (empty($DATA['username']) && !preg_match("/^[a-zA-z ]+$/", $DATA['username'])) {

            $this->errors['username'] = "Only letters are allowed in username";
        }

        if (empty($DATA['email']) && !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            
            $this->errors['email'] = "Please enter a valid email";
        }

        if ($this->where('email', $DATA['email'])) {
            
            $this->errors['email'] = "E-mail already Exists";
        }

        if (empty($DATA['password']) && strlen($DATA['password'] <= 8)) {
            
            $this->errors['password'] = "Password must be at leasts 8 characters";
        }

        if (count($this->errors) == 0) 
        {
            return true;
        }

        return false;
    }


    # MAKE USER ID
    public function make_user_id($data)
    {
        $data['user_id'] = randomString(60);
        return $data;
    }

    # HASH PASSWORD
    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    
}