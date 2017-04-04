<?php
    $user = Session::get('user');
    $profile = Auth::get_profile_fields();    

    // using the Form class
    echo \Form::csrf();

    // using a form instance
    $form = \Form::forge();
    $form->add_csrf();    
   
    // Start form for sign in
    echo $form->open(array('action' => '/collections/edit_record/' . $album->id, 'method' => 'post', 'class' => 'form-signin'));
?>

    <h2 class="form-signin-heading">Edit CD</h2>
    
    <?php         
        //Back to sign in
        echo '<a href="/collections/records/current_user">Go To Your CD Collection</a><br>';

        //artist input
        echo $form->label('Artist:', 'artist');         
        echo $form->input('artist', Input::post('artist', isset($album->artist) ? $album->artist : ''), 
            array('class'     => 'form-control', 
                  'required'  => 'required', 
                  'autofocus' => 'autofocus'));        
        //album input
        echo $form->label('Album:', 'album');         
        echo $form->input('album', Input::post('album', isset($album->album) ? $album->album : ''), 
            array('class'    => 'form-control', 
                  'required' => 'required'));     

        //release year input
        echo $form->label('Release Year:', 'release_year');         
        echo $form->input('release_year', Input::post('release_year', isset($album->release_year) ? $album->release_year : ''),
            array('class'    => 'form-control', 
                  'required' => 'required'));
        //label input
        echo $form->label('Record Label:', 'label');         
        echo $form->input('label', Input::post('label', isset($album->label) ? $album->label : ''),
            array('class'    => 'form-control', 
                  'required' => 'required'));
        ?>

        <input type="hidden" name="album_id" value="<?php echo $album->id; ?>">

        <!--Add CSRF security token-->
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" /><br>
    <?php
        //Submit button
        echo $form->submit('edit', 'Edit', array('class' => 'btn btn-lg btn-primary btn-block')) . "<br>";
        
        //Close form
        echo $form->close();
                
    ?>