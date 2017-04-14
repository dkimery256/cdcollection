<?php
//Controller for CD collection actions
class Controller_Tracks extends Controller_Template{

    //Show user all tracks added for selected album
    public function action_cd_tracks($artist, $album, $CID){        
        try{
            $tracks = Model_Tracks::find('all', array(
                'where' => array(
                    array('track_id', $CID),
                ),
                'where' => array(
                    array('album', $album ),
                ),
            ));
        $data = array('tracks' => $tracks, 'artist' => $artist, 'album' => $album, 'track_id' => $CID);        
        $this->template->title = 'Tracks\'s';
        $this->template->content = View::forge('tracks/tracks', $data);
        } catch (Database_Exception $e){
            $error = "There was an error processing your information with the database";
            Response::redirect('/error/error/' . $error );
        }        
    }    

    //Add CD to Collection
    public function action_add_tracks($track_amount, $track_id, $album){        
        if (Input::post('add_tracks')){			
			// check for a valid CSRF token
			if ( \Security::check_token()){				
				try{
                    //Add tracks to database
                    for($i = 1; $i <= $track_amount; $i++){
                       $tracks = new Model_Tracks();
                       $tracks->track_id = $track_id;
                       $tracks->album = $album;
                       $tracks->track_number = Input::post('track'. $i);
                       $tracks->title = Input::post('title');
                       $tracks->length = Input::post('length');
                       $tracks->save();
                    }
                    
                    Session::set_flash('success','Tracks Added');
                    Response::redirect('/collections/records/current_user');

                }catch(Database_Exception $e){
					$error = "There was an error processing your information with the database";
					Response::redirect('/error/error/' . $error );
                }
            }else{
                $error = "You tried to do something bad, or the CSRF token is expired.";
				Response::redirect('/error/error/' . $error);
            }
        }else{
            $error = "There was an error processing your information with the server";
			Response::redirect('/error/error/' . $error );            
        }        
    }

    public function action_edit_record($id){
        if(Input::post('edit')){
			$album = Model_Collections::find(Input::post('album_id'));
			$album->artist = Input::post('artist');
			$album->album = Input::post('album');
			$album->release_year = Input::post('release_year');
			$album->label = Input::post('label');			
			$album->save();

			Session::set_flash('success', 'CD Updated');

			Response::redirect('/collections/records/current_user');
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

    //Show user all their CDs
    public function action_delete_record($id){        
        $album = Model_Collections::find($id);
        $album->delete();
        Session::set_flash('success', 'CD Deleted');
		Response::redirect('/collections/records/current_user');
    }
}
?><?php
//Controller for CD collection actions
class Controller_Collections extends Controller_Template{

    //Show user all their CDs
    public function action_records($status){        
        $user = Session::get('user');
        $CID = Auth::get('created_at');
        $albums = Model_Collections::find('all',  array('where' => array('collection_id' => $CID)));

        if($status == null){
            $data = array('albums' => $albums);
        }else{
            $data = array('albums' => $albums, 'status' => $status);
        }
        
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
			$album = Model_Collections::find(Input::post('album_id'));
			$album->artist = Input::post('artist');
			$album->album = Input::post('album');
			$album->release_year = Input::post('release_year');
			$album->label = Input::post('label');			
			$album->save();

			Session::set_flash('success', 'CD Updated');

			Response::redirect('/collections/records/current_user');
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

    //Show user all their CDs
    public function action_delete_record($id){        
        $album = Model_Collections::find($id);
        $album->delete();
        Session::set_flash('success', 'CD Deleted');
		Response::redirect('/collections/records/current_user');
    }
}
?>