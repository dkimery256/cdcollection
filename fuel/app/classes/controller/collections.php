<?php
//Controller for CD collection actions
class Controller_Collections extends Controller_Template{

    //Show user all their CDs
    public function action_records($status){        
        $user = Session::get('user');
        $CID = Auth::get('created_at');
        $albums = Model_Collections::find('all',  array('where' => array('collection_id' => $CID)));
        $data = array('albums' => $albums, 'status' => $status);
        $this->template->title = 'Your CD\'s';
        $this->template->content = View::forge('collections/records', $data);
    }

    //Add CD to Collection
    public function action_add_record($status){        
        if (Input::post('add')){			
			// check for a valid CSRF token
			if ( \Security::check_token()){				
				try{
                    $user = Session::get('user');
                    $CID = Auth::get('created_at');	
                    if($status == "new_user"){                        			
				        $album = Model_Collections::find('first', array('where' => array('collection_id' => $CID)));
                        $album->artist = Input::post('artist');
                        $album->album = Input::post('album');
                        $album->release_year = Input::post('release_year');
                        $album->label = Input::post('label');
                        $album->save();
                        $status = 'current_user';
                    }elseif($status == "current_user"){
                        $CID = Auth::get('created_at');	
                        $album = new Model_Collections();
                        $album->artist = Input::post('artist');
                        $album->album = Input::post('album');
                        $album->release_year = Input::post('release_year');
                        $album->label = Input::post('label');
                        $album->collection_id = $CID;
                        $album->save();
                    }

                    Response::redirect('/collections/records/' . $status);

                }catch(Database_Exception $e){
					$error = "There was an error processing your information with the database";
					Response::redirect('/error/error/' . $error );
                }
            }else{

            }
        }else{
            if(isset($status) && $status != null)
            $data = array('status' => $status);
        else
            $data = array();
            $this->template->title = 'Add CD';
            $this->template->content = View::forge('collections/add_record', $data);
        }        
    }

    public function action_edit_record($id){
        if(Input::post('edit')){
			$post = Model_Post::find(Input::post('post_id'));
			$post->title = Input::post('title');
			$post->category = Input::post('category');
			$post->body = Input::post('body');
			$post->tags = Input::post('tags');
			$post->create_date = date('Y-m-d H:i:s');
			$post->save();

			Session::set_flash('success', 'Post Updated');

			Response::redirect('/posts/view/' . $post->id);
		}		
		$album = Model_Collections::find('first', array(
			'where' => array(
				'id' => $id
			)
		));
		$data = array('album' => $album);
        $this->template->title = 'Edit Album';
        $this->template->content = View::forge('collections/edit_record', $data);   
    }
}
?>