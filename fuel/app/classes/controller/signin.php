<?php

//Contoller for login, registering, and logout
class Controller_Signin extends Controller_Template{
	
	//Home page
	public function action_index(){
		$data = array();
        $this->template->title = 'Sign In';
        $this->template->content = View::forge('signin/index', $data);
	}
	
	//Contorller action for login
	public function action_login(){
		
		
	}


	//Contoller action for registering
	public function action_register(){
		$data = array();
        $this->template->title = 'Register';
        $this->template->content = View::forge('signin/register', $data);
	}
}
?>