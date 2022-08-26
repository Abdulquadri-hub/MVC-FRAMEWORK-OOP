<?php

/*
* Signup controller class 
*/

class Signup extends Controller 
{
    public function index($id = null)
    {
        /*
         * signup  
         */
        $errors = [];

        if (count($_POST) > 0) 
        {
            $user = new User();

            if ($user->validate($_POST)) {

                $user->insert($_POST);
                // $this->redirect("login");
            }else {
                
                $errors = $user->errors;
            }
        }
        // $user->insert();
        $this->view("signup",[
            'errors'=>$errors,
        ]);
    }
}
