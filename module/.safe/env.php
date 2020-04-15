<?php

$files[] = 'query-builder';
$files[] = 'dbconnect';
$files[] = 'auth/login-auth';
$files[] = 'auth/auth-mode';
$files[] = 'auth/auth-session';
$files[] = 'auth/defaulttoken';
$files[] = 'auth/session-loader';
$files[] = 'auth/auth-expire';



#--------------------------------------------------------------------------
$prefix="module/";

$extension=explode(".",$_SERVER['PHP_SELF']);
#-----------------------------------------------------------------------------

foreach ($files as $k => $value) {
	# code...
	require $prefix.$value.".".$extension[1];

}


?>