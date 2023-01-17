<?php 

/**
 *  REQUEST CLASS 
 *  THIS CONTANS ALL THE REQUEST METHODS
 */

defined('ROOTPATH') OR exit('Access Denied!');

class Request{

    # CHECK WHICH METHOD WAS USED
    public static function method():string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    # CHECK IF SOMETHING WAS POSTED
    public static function posted(): bool
    {
        if($_SERVER['REQUEST_METHOD'] == "POST" && count($_POST) > 0)
        {
            return true;
        }
        return false;
    }

    # GET A VALUE FROM THE POST VARIABLE
    public static function post(string $key = '', mixed $default = ''):mixed
    {
        if(empty($key))
        {
            return $_POST;
        }else{
            if(isset($_POST[$key]))
            {
                return $_POST[$key];
            }
        }
        return $default;
    }

    # GET All OR A  VALUE FROM THE FILES VARIABLE
    public static function files(string $key = '', mixed $default = ''):mixed
    {
        if(empty($key))
        {
            return $_FILES;
        }else{
            if(isset($_FILES[$key]))
            {
                return $_FILES[$key];
            }
        }
        return $default;
    }

    # GET All OR A  VALUE FROM THE GET VARIABLE
    public static function get(string $key = '', mixed $default = ''):mixed
    {
        if(empty($key))
        {
            return $_GET;
        }else{
            if(isset($_GET[$key]))
            {
                return $_GET[$key];
            }
        }
        return $default;
    }

    # GET All OR A  VALUE FROM THE REQUEST VARIABLE
    public static function input(string $key = '', mixed $default = ''):mixed
    {
        if(empty($key))
        {
            return $_REQUEST;
        }else{
            if(isset($_REQUEST[$key]))
            {
                return $_REQUEST[$key];
            }
        }
        return $default;
    }

    # GET ALL EITHER POST OR GET
    public static function all(): mixed
    {
        return $_REQUEST;
    }


}
