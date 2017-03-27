
<?php    
    //Destroy user session if exits
    $user = Session::get('user');
    if($user != null)
        Session::delete('user');
    
    // using the Form class
    echo \Form::csrf();

    // using a form instance, will also add a validation rule to forms fieldset
    $form = \Form::forge();
    $form->add_csrf();
    
    // Start form for sign in
    echo $form->open(array('action' => '/signin/login', 'method' => 'post', 'class' => 'form-signin'));
?>

    <h2 class="form-signin-heading">Please sign in</h2>
    
    <!--Show if user successfully registered or not-->
    <?php if(Session::get_flash('success')) : ?>
        <div class="alert alert-success"> <?php echo Session::get_flash('success'); ?></div>
    <?php endif; ?>
    <?php if(Session::get_flash('error')) : ?>
        <div class="alert alert-danger"> <?php echo Session::get_flash('error'); ?></div>
    <?php endif; ?>

    <?php 
        //Username or email input
        echo $form->label('Email or Username', 'text', array('class' => 'sr-only'));         
        echo $form->input('username', '', array('class'   => 'form-control', 
                                            'required'    => 'required', 
                                            'autofocus'   => 'autofocus',
                                            'placeholder' => 'Email or Username'));            

        //Password input
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
     