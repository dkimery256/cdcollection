<?php
return array(
	'_root_'  => 'signin/index',  // The default route
	'_404_'   => 'welcome/404',   // The main 404 route
	'_error_' => 'error/error',   // The main error route
	'_CDs_'   => 'collections/records', // User's collection of CD's	
	'_cdtracks_' => 'tracks/cd_tracks', // User's CD tracks'
	'_inputs_'   => 'inputs/track_inputs' , 
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
