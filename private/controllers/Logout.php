<?php

/*
* Logout controller class 
*/

class Logout extends Controller 
{
    function index($id = null)
    {
/**
 *  logout user
 */
        Auth::logout();
        $this->redirect("login");
    }
}
