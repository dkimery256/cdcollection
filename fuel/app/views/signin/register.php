<?php
    // using the Form class
    echo \Form::csrf();

    // using a form instance, will also add a validation rule to forms fieldset
    $form = \Form::forge();
    $form->add_csrf();
    
    // Start form for sign in
    echo $form->open(array('action' => '/signin/login', 'method' => 'post', 'class' => 'form-signin'));
?>

    <h2 class="form-signin-heading">Register Form</h2><br>
    <?php 
        //first name
        echo $form->label('First Name:', 'f_name');         
        echo $form->input('f_name', '', array('class'     => 'form-control', 
                                            'required'    => 'required', 
                                            'autofocus'   => 'autofocus',
                                            'placeholder' => 'First Name'));            

        //last name
        echo $form->label('Last Name:', 'l_name');         
        echo $form->input('l_name', '', array('class'        => 'form-control', 
                                                  'required'    => 'required',
                                                  'placeholder' => 'Last Name'));
        
        //username
        echo $form->label('Username:', 'username');         
        echo $form->input('username', '', array('class'      => 'form-control', 
                                                  'required'    => 'required',
                                                  'placeholder' => 'Username'));
        ?>
        <!--Add CSRF security token-->
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" /><br>
    <?php
        //Submit button
        echo $form->submit('sign_in', 'Sign In', array('class' => 'btn btn-lg btn-primary btn-block')) . "<br>";
        //Register new user
        echo '<a href="/signin/index/">Sign In</a>';
        //Close form
        echo $form->close();
                
    ?>