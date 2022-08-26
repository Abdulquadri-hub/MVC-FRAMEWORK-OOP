<?php

/*
* Profile controller class 
*/

class Profile extends Controller 
{
    public function index($id = "")
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

        $row = $user->first("user_id", $id);


/*
* view the controller and get results
*/
        $this->view("profile",['row'=>$row]);
    }
}
