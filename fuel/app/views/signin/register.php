<?php
    // using the Form class
    echo \Form::csrf();

    // using a form instance
    $form = \Form::forge();
    $form->add_csrf();    
   
    // Start form for sign in
    echo $form->open(array('action' => '/signin/process_new_user', 'method' => 'post', 'class' => 'form-signin'));
?>

    <h2 class="form-signin-heading">Register Form</h2>
    
    <?php         
        //Back to sign in
        echo '<a href="/signin/index/">Back to Sign In</a><br>';

        //first name input
        echo $form->label('First Name:', 'first');         
        echo $form->input('first', '', array('class'     => 'form-control', 
                                            'required'    => 'required', 
                                            'autofocus'   => 'autofocus',
                                            'placeholder' => 'First Name'));        
        //last name input
        echo $form->label('Last Name:', 'last');         
        echo $form->input('last', '', array('class'       => 'form-control', 
                                            'required'    => 'required',
                                            'placeholder' => 'Last Name'));        
        //username input
        echo $form->label('Username:', 'username');         
        echo $form->input('username', '', array('class'       => 'form-control', 
                                                'required'    => 'required',
                                                'placeholder' => 'Username'));
        //email input
        echo $form->label('Email:', 'email');         
        echo $form->input('email', '', array('class'       => 'form-control', 
                                             'required'    => 'required',
                                             'placeholder' => 'yourMail@mail.com'));

        //password input
        echo $form->label('Password', 'password');         
        echo $form->password('password', '', array('class'       => 'form-control', 
                                                   'required'    => 'required',
                                                   'placeholder' => 'Password'));
        
        /*verify password input
        echo $form->label('Password', 'vpassword');         
        echo $form->password('vpassword', '', array('class'       => 'form-control', 
                                                    'required'    => 'required',
                                                    'placeholder' => 'Verify Password'));*/
        ?>
        <!--Add CSRF security token-->
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" /><br>
    <?php
        //Submit button
        echo $form->submit('register', 'Register', array('class' => 'btn btn-lg btn-primary btn-block')) . "<br>";
        
        //Close form
        echo $form->close();
                
    ?>