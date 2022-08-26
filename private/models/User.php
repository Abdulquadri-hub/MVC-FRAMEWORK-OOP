<?php

/*
* user model class 
* This contain all validation and inst logic for the  controller class
* Validation and the likes..
*/

class User extends Model 
{

    protected $beforeInsert = ['make_user_id','hash_password'];

    protected $allowedColumns = ['username','email', 'password', 'date'];


    public function validate($DATA)
    {
        $this->errors = [];

/*
* User Validations
*/

        if (empty($DATA['username']) && !preg_match("/^[a-zA-z ]+$/", $DATA['username'])) {

            $this->errors['username'] = "Only letters are allowed in username";
        }

        if (empty($DATA['email']) && !filter_var($DATA['email'], FILTER_VALIDATE_EMAIL)) {
            
            $this->errors['email'] = "Please enter a valid email";
        }

        if ($this->where('email', $DATA['email'])) {
            
            $this->errors['email'] = "E-mail already Exists";
        }

        if (empty($DATA['password']) && strlen($DATA['password'] < 4)) {
            
            $this->errors['password'] = "Password must be at leasts 4 characters";
        }

/**
 *  save user
*/
        if (count($this->errors) == 0) 
        {
            return true;
        }

        return false;
    }

/**
* Functions logic before insert
*/

    public function make_user_id($data)
    {
        $data['user_id'] = randomString(60);
        return $data;
    }

    public function hash_password($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $data;
    }

    
}