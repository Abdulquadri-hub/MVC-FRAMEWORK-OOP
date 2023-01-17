<?php

/*
* _404
*/

class _404 
{
    use MainController;

    public function index($id = null)
    {
        echo "Controller page not found";
    }
}
