
</style>
<?php
// using the Form class
    echo \Form::csrf();

    // using a form instance
    $form = \Form::forge();
    $form->add_csrf(); 

    //If tracks do not exist ask how many the user want to add   
    if($tracks == null) {
        echo '<p>You do not have any tracks saved for this CD.</p>';
        echo '<a href="/collections/records/current_user">Go to your CD Collection</a><br><br>';
        
        echo '<h2 class="form-signin-heading">Add tracks</h2>';
        echo $form->label('Add Tracks:', 'tracks');
        echo $form->select('tracks', 'none', array(
            '1'  => '1',
            '2'  => '2',         
            '3'  => '4',
            '4'  => '4',
            '5'  => '5',
            '6'  => '6',
            '7'  => '7',
            '8'  => '8',
            '9'  => '9',
            '10' => '10',
            '11' => '11',
            '12' => '12',
            '13' => '12',
            '14' => '14',
            '15' => '15',
        ),array('id' => 'addtracks'));
        echo '&nbsp&nbsp';
        echo $form->button('add', 'Create Inputs', array('id' => 'select_click', 'class' => 'btn'));
    } else {

    }
    
?>