<?php
return array(
	'_root_'  => 'signin/index',  // The default route
	'_404_'   => 'welcome/404',   // The main 404 route
	'_error_' => 'error/error',   // The main error route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
