<?php

//Class to help build inputs for tracks
class Controller_Inputs extends Controller_Rest{

    //Get selected amount of user desired tracks
    public function get_track_inputs(){
                
        // get tracks passed to get 
        $tracks = Input::get('tracks');
        $track_id = Input::get('track_id');
        $album  = Input::get('album');
        $count  = 1;

        // using the Form class
        echo \Form::csrf();

        // using a form instance
        $form = \Form::forge();
        $form->add_csrf();    

        echo $form->open(array('action' => '/tracks/add_tracks/'. $tracks .'/'. $track_id .'/'. $album , 'method' => 'post'));
        //echo table form headers
        echo '<br><table>
                <th>Track Number</th>
                <th>Title</th>
                <th>Length</th>';
        while($count <= $tracks){
            echo '<tr>';
                echo '<td>'. $form->input('track'. $count, $count, array('class' => 'form-control')) .'</td>';
                echo '<td>'. $form->input('track_name', '', array('class' => 'form-control')) .'</td>';
                echo '<td>'. $form->input('length', '', array('class' => 'form-control')) .'</td>';
            echo '</tr>';
            $count++;
        }       
        echo '</table>';
        echo $form->input('track_amount', $count, array('type' => 'hidden', 'id' => 'track_amount'));
        echo $form->input('track_id', $track_id, array('type' => 'hidden', 'id' => 'track_id'));
        //Add CSRF security token
        echo $form->input(\Config::get('security.csrf_token_key'), \Security::fetch_token(), array('type' => 'hidden')). '<br>';
         //Submit button
        echo $form->submit('add_tracks', 'Add Tracks', array('class' => 'btn-primary'));
        echo $form->close();                
    }
}

?>