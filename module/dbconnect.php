<?php

require 'inc.php';

DB_VAR;

foreach ($db as $dbkey => $values) {
	
	@define(strtoupper($dbkey),$values);
}

#make connection Object

$con=mysqli_connect(HOST,USER,PASS,DB);

#print_r($con);

if(!$con):

	die('Connection Error');

endif;


?>