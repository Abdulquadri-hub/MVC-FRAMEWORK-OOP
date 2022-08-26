<?php

/**
 * Authentication class
 */

class Auth 
{
    public static function authenticate($row)
    {
        $_SESSION['USER'] = $row;
    }

    public static function logout()
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }
    }

    public static function logged_in()
    {
        if (isset($_SESSION['USER'])) {
            return true;
        }
        return false;
    }

    public static function user()
    {
        if (isset($_SESSION['USER'])) {
            return $_SESSION['USER']->username;
        }
        return false;
    }

    /**
     * get User authomatically
     */
    public static function __callStatic($function, $params)
    {
        // $value = $params[0];
        $column = strtolower(str_replace("get", "", $function));
        if (isset($_SESSION['USER']->$column)) {
            return $_SESSION['USER']->$column;
        }
        return 'unknown';
        
    }
}