<?php

//Model for user a CD
class Model_CD extends Orm\Model {
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