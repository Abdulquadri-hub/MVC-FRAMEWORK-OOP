<?php

/*
* User controller class 
*/

class Users extends Controller 
{
    public function index($id = null)
    {
/**
 *  check if user is logged in or not
 */
        if (!Auth::logged_in()) 
        {
            $this->redirect("login");
        }

/*
* load model
*/
        $user = new User();

        $data = $user->findAll();


/*
* view the controller and get results
*/
        $this->view("users",['rows'=>$data]);
    }
}
