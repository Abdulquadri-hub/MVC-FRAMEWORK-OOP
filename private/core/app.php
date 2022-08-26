<?php

/*
* App class 
www.mywebsite.com/students/class/id
*/

class App
{
    protected $controller = "home";
    protected $method = "index";
    protected $params = array();

    public function __construct()
    {
        $URL = $this->get_url();
        if (file_exists(ROOT."/private/controllers/".$URL[0]. ".php")) {
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }
        require(ROOT."/private/controllers/".$this->controller. ".php");
        $this->controller = new $this->controller;

        /*
        * set  url method 
        */
        if(isset($URL[1]))
        {
            if (method_exists($this->controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        /*
        * set param 
        */
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