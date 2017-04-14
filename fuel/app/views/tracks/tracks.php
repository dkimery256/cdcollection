
</style>
<?php
    echo '<h3 id="artist" style="float: left;">'. $artist .'</h3>';
    echo '<h3 style="float: left;">-&nbsp&nbsp</h3>';
    echo '<h3 id="album" style="float: left;">'. $album .'</h3>';
    echo '<div id="track_id" style="display: none;">'. $track_id .'</div>';
    //If tracks do not exist ask how many the user want to add   
    if($tracks == null) {
        echo '<br><br><br><a href="/collections/records/current_user">Go to your CD Collection</a>';
        echo '<br><br><div id="select_tracks">';
        echo '<p>You do not have any tracks saved for this CD.</p>';
        echo '<h3 class="form-signin-heading">Add tracks</h3>';
        echo Form::label('Number of Tracks:&nbsp&nbsp', 'tracks');
        echo Form::select('tracks', 'none', array(
            '1'  => '1',
            '2'  => '2',         
            '3'  => '3',
            '4'  => '4',
            '5'  => '5',
            '6'  => '6',
            '7'  => '7',
            '8'  => '8',
            '9'  => '9',
            '10' => '10',
            '11' => '11',
            '12' => '12',
            '13' => '13',
            '14' => '14',
            '15' => '15',
            '16' => '16',
            '17' => '17',
            '18' => '18',
            '19' => '19',
            '20' => '20',
        ),array('id' => 'addtracks'));
        echo '&nbsp&nbsp';
        echo Form::button('add', 'Create Inputs', array('id' => 'select_click', 'class' => 'btn'));  
        echo '</div>';     
        echo '<div id="select_form"></div>';
           
       
    } else {

    }
    
?>