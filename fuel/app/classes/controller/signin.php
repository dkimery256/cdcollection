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
				//sign in code goes here
				Auth::login($name, $password);
				Session::set('user', $user);				
				$CID = Auth::get('created_at');
				//CID is used as FK to filter out new user vs returning user if record equal 0
				$record = Model_Collections::find('first', array('where' => array('collection_id' => $CID)));
				$year = $record->release_year;
				if($year == 0){
					//Welcome user to CD Collection Add CD page
					$status = 'new_user';
					Response::redirect('collections/add_record/' . $status);
				}else{
					//Welcome user to their list of CD's
					$status = 'current_user';
					Response::redirect('collections/records/' . $status);
				}
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
		if (Input::post('register')){			
			// check for a valid CSRF token
			if ( \Security::check_token()){				
				try{
					$first = Input::post('first');
					$last = Input::post('last');
					$username = Input::post('username');
					$email = Input::post('email');					
					if(Auth::create_user(					
						$username,					
						Input::post('password'),
						$email,
						1,
						array(
							'first' => $first,
							'last' => $last
					))){
						//Create blank album for new user
						$CID = Model_Users::find('last', array('select' => array('created_at')));						
						$collections = new Model_Collections();
						$collections->collection_id = $CID->created_at;				
						$collections->artist = 'new';
						$collections->album = 'new';
						$collections->release_year = 0;
						$collections->label = 'new';
						$collections->save(); 
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
				}catch(SimpleUserUpdateException $e){
					Session::set_flash('error', 'That email or username already exists.');
					Response::redirect('/');					
				}
			// CSRF attack or expired CSRF token
			}else{				
				$error = "You tried to do something bad, or the CSRF token is expired.";
				Response::redirect('/error/error/' . $error);
			}			
		}else{		
			$data = array();
			$this->template->title = 'Register';
			$this->template->content = View::forge('signin/register', $data);
		}		
	}

	//Contoller action for registering a new user
	public function action_process_new_user(){
		//Check for post
		
	}
}
?>