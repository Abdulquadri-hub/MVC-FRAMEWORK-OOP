<?php

/**
 * helpers functions
 */
/*


 * get $_POST values
 */
function get_val($key)
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return "";
}


/* get $_POST select values
*/
function get_select($key, $value)
{
    if (isset($_POST[$key])) {
        
        if ($_POST[$key] == $value) {
            
            return "selected" ; 
        }
    }
    return "";
}


/* 
*get $_POST values
*/
function esc($val)
{
    return htmlspecialchars($val);
}

/* 
*get random strings
*/
function randomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = "";

    for ($i=0; $i < $length; $i++) 
    { 
        $index = rand(0, strlen($characters) - 1);
        $string .= $characters[$index];
    }
    return $string;
}

/*
* show function
*/
function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/*
* get date function
*/
function get_date($date)
{
    return date("jS, M, Y", strtotime($date));
}

/*
* get image function
*/
function get_image($image)
{
    if (!file_exists($image)) {
        $image = ASSET.$image;
    }
    return $image;
}

