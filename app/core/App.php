<?php

defined('ROOTPATH') OR exit('Access Denied!');

/*
* App class 
*/

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params = array();

    public function __construct()
    {
        $URL = $this->get_url();

        if (file_exists(ROOT_PATH."/app/controllers/".$URL[0]. ".php")) {
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }else {
            require(ROOT_PATH."/app/controllers/_404.php");
        }
        
        require(ROOT_PATH."/app/controllers/".$this->controller. ".php");
        $this->controller = new $this->controller;



        if(isset($URL[1]))
        {
            if (method_exists($this->controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        $URL = array_values($URL);
        $this->params = $URL;

        call_user_func_array([$this->controller,$this->method], $this->params);

    }


    protected function get_url()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        return explode("/", filter_var(trim($url, "/")), FILTER_VALIDATE_URL);
    }
}