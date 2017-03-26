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
		//Check for post
		if(Input::post('sign_in')){
			// check for a valid CSRF token
			if ( \Security::check_token()){				
			// token is valid, you can process the form input
			$name = Input::post('username');
			$password = Input::post('password');
			$user = Auth::validate_user($name, $password);
			if($user){
				echo $user;
			}else{
				Session::set_flash('error', 'Invalid username/email or password.');
				Response::redirect('/');
			}
			}else{
				// CSRF attack or expired CSRF token
				$error = "You tried to do something bad! or CSRF token is expired.";
				Response::redirect('/error/error/' . $error);
			}
						
		}else{
			$error = "There was an error with the server connection";
		    Response::redirect('/error/error/' . $error);
		}		
	}


	//Contoller action for register page
	public function action_register(){		
		$data = array();
        $this->template->title = 'Register';
        $this->template->content = View::forge('signin/register', $data);
	}

	//Contoller action for registering a new user
	public function action_process_new_user(){
		//Check for post
		if (Input::post('register')){			
			// check for a valid CSRF token
			if ( \Security::check_token()){				
				try{
					$first = Input::post('first');
					$last = Input::post('last');
					if(Auth::create_user(					
						Input::post('username'),					
						Input::post('password'),
						Input::post('email'),
						1,
						array(
							'first' => $first,
							'last' => $last
					))){
						//Create success token
						Session::set_flash('success', 'You are now Registered!');
						Response::redirect('/');						
					}else{
						//Create error token
						Session::set_flash('error', 'You were not Registered!');
						Response::redirect('/');
					}
				}catch(Database_Exception $e){
					$error = "There was an error processing your information with the database";
					Response::redirect('/error/error/' . $error );
				}
			// CSRF attack or expired CSRF token
			}else{				
				$error = "You tried to do something bad! or CSRF token is expired.";
				Response::redirect('/error/error/' . $error);
			}			
		}else{		
			$error = "There was an error with the server connection";
			Response::redirect('/error/error/' . $error);
		}
	}
}
?>