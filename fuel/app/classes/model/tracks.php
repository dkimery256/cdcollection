<?php

//Model for user CD Collections
class Model_Tracks extends Orm\Model {
    protected static $_properties = array(
        'id',
        'track_id',
        'track_number',
        'title',
        'length',
        'album'
    );
}

?>