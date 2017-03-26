<?php

//Contoller for login, registering, and logout
class Controller_Error extends Controller_Template{

    public function action_error($error){
            $data = array('error' => $error);
            $this->template->title = 'Sorry!';
            $this->template->content = View::forge('error/error', $data);
        }

}