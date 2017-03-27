<?php

//Model for user CD Collections
class Model_Collections extends Orm\Model {
    protected static $_properties = array(
        'id',
        'collection_id',
        'artist',
        'album',
        'release_year',
        'label'
    );
}

?>