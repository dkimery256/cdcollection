<?php

//Model for users
class Model_Users extends Orm\Model {
    protected static $_properties = array(
        'id',
        'username',
        'password',
        'email',
        'profile_fields',
        'group',
        'last_login',
        'login_hash',
        'created_at'
    );
}

?>