<?php

defined('ROOTPATH') OR exit('Access Denied!');

/**  CHECK WHICH PHP EXTENSION IS REQUIRED **/
check_extensions();
function check_extensions()
{
    $required_extensions = [
		'gd',
		'mysqli',
		'pdo_mysql',
		'pdo_sqlite',
		'curl',
		'fileinfo',
		'intl',
		'exif',
		'mbstring',
		//'smtp',
    ];

    $not_loaded = [];

    foreach ($required_extensions as $ext) 
    {
        if(!extension_loaded($ext))
        {
            $not_loaded[] = $ext;
        }

        if(!empty($not_loaded))
        {
            show("Please load the following extension in you php.ini file: <br>".implode("<br>",$not_loaded));
            die;
        }
    }
}

/** ESCAPE VALUES */
function esc($val)
{
    return htmlspecialchars($val);
}


function randomString(int $length):string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = "";
    $max = (strlen($characters) - 1);
    $min = 0;

    for ($i=0; $i < $length; $i++) 
    { 
        $index = rand($min, $max);
        $string .= $characters[$index];
    }
    return $string;
}


function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function get_date($date)
{
    return date("jS, M, Y", strtotime($date));
}

/**  LOAD IMAGE. IF NOT EXISTS LOAD PLACEHOLDER **/

function get_image(mixed $image = '', string $gender = ''):string
{
    $image = $image ?? '';

    if(file_exists($image))
    {
        $image =  ROOT_URL . $image;
    }

    if($gender == 'male')
    {
        $image = ROOT_URL . "asset/images/user.png";

    }elseif ($gender == 'female') {
    
        $image = ROOT_URL . "asset/images/userf.png";
    }else {

        $image = ROOT_URL . "asset/images/no_image.jpg";
    }

    return  $image;
}

/**  DISPLAY A OLD VALUE WHEN AN INPUT IS CHECKED  **/

function old_value(mixed $key, mixed $default = '', string $mode = 'post'):mixed
{
    $POST = $mode == 'post' ? $_POST : $_GET;
    if (isset($POST[$key])) 
    {
        return $POST[$key];
    }
    return $default;
}

function old_checked(mixed $key, mixed $value, mixed $default = ""):mixed
{
    if($_POST[$key] == $value)
    {
        return " checked ";
    }else{

        if($_SERVER['REQUEST_METHOD'] == "GET" && $default == $value)
        {
            return " checked ";
        }
    }
    return '';
}


function old_select($key, $value, mixed $default = "", string $mode = 'post')
{

    $POST = ($mode == 'post') ? $_POST : $_GET ;
    if (isset($POST[$key])) {
        
        if ($POST[$key] == $value) 
        {
            return " selected "; 
        
        } else {

            if ($default == $value) 
            {
                return " selected "; 
            }
        }
    }

    return $default;
}


/** SET, DISPLAY MEESSAGE. DELETE ON TRUE CONDITION */
function message(mixed $message = null, bool $clear = false): mixed
{
    if (!empty($message)) 
    {
        Session::set('message',$message);
    }else
        if (!Session::get('message')) {

            $message = Session::get('message');

            if($clear)
            {
                Session::pop('message');
            }
            return $message;
        }

        return false;
}

function views_path($include){

    if (file_exists(ROOT_PATH."/app/views/includes/". $include . ".inc.php"))
    {
        return (ROOT_PATH."/app/views/includes/". $include . ".inc.php");
    }else {
        return (ROOT_PATH."/app/views/404.view.php");
    }
}


