
<?php
    // using the Form class
    echo \Form::csrf();

    // using a form instance, will also add a validation rule to forms fieldset
    $form = \Form::forge();
    $form->add_csrf();
    
    // Start form for sign in
    echo $form->open(array('action' => '/signin/login', 'method' => 'post', 'class' => 'form-signin'));
?>

    <h2 class="form-signin-heading">Please sign in</h2>
    <?php 
        //Username or email input
        echo $form->label('Email or Username', 'text', array('class' => 'sr-only'));         
        echo $form->input('username', '', array('class'   => 'form-control', 
                                            'required'    => 'required', 
                                            'autofocus'   => 'autofocus',
                                            'placeholder' => 'Email or Username'));            

        //Password inputs
        echo $form->label('Password', 'password', array('class'  => 'sr-only'));         
        echo $form->password('password', '', array('class'       => 'form-control', 
                                                  'required'    => 'required',
                                                  'placeholder' => 'Password'));
        ?>
        <!--Add CSRF security token-->
        <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key');?>" value="<?php echo \Security::fetch_token();?>" />
    <?php
        //Submit button
        echo $form->submit('sign_in', 'Sign In', array('class' => 'btn btn-lg btn-primary btn-block')) . "<br>";
        //Register new user
        echo '<a href="/signin/register/">Register New User</a>';
        //Close form
        echo $form->close();
                
    ?>
     