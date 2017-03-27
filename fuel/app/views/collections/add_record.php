<?php
    $user = Session::get('user');
    $profile = Auth::get_profile_fields();
    if (isset($status)){
        if($status == "new_user")
            echo sprintf('<h3>Welcome %s %s! This is your first login, go ahead and add a CD.</h3>', $profile['first'], $profile['last']);    
}

    // using the Form class
    echo \Form::csrf();

    // using a form instance
    $form = \Form::forge();
    $form->add_csrf();    
   
    // Start form for sign in
    echo $form->open(array('action' => '/collections/add_record/' . $status, 'method' => 'post', 'class' => 'form-signin'));
?>

    <h2 class="form-signin-heading">Add CD</h2>
    
    <?php         
        //Back to sign in
        echo sprintf('<a href="/collections/records/%s">Go To Your CD Collection</a><br>', $status);

        //artist input
        echo $form->label('Artist:', 'artist');         
        echo $form->input('artist', '', array('class'   => 'form-control', 
                                            'required'  => 'required', 
                                            'autofocus' => 'autofocus'));        
        //album input
        echo $form->label('Album:', 'album');         
        echo $form->input('album', '', array('class'       => 'form-control', 
                                            'required'    => 'required'));        
        //release year input
        echo $form->label('Release Year:', 'release_year');         
        echo $form->input('release_year', '', array('class'    => 'form-control', 
                                                    'required' => 'required'));
        //label input
        echo $form->label('Record Label:', 'label');         
        echo $form->input('label', '', array('class'    => 'form-control', 
                                             'required' => 'required'));
        ?>
        <!--Add CSRF security token-->
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" /><br>
    <?php
        //Submit button
        echo $form->submit('add', 'Add', array('class' => 'btn btn-lg btn-primary btn-block')) . "<br>";
        
        //Close form
        echo $form->close();
                
    ?>