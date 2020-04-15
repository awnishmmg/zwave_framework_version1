<?php

$files[] = 'query-builder';
$files[] = 'dbconnect';
$files[] = 'auth/login-auth';
$files[] = 'auth/auth-mode';
$files[] = 'auth/auth-session';
$files[] = 'auth/defaulttoken';
$files[] = 'auth/session-loader';
$files[] = 'auth/auth-expire';
$files[] = 'get-table-info';


#--------------------------------------------------------------------------
$prefix="module/";

#$prefix=dirname(__DIR__)."/module/";

$extension=explode(".",$_SERVER['PHP_SELF']);
#-----------------------------------------------------------------------------

foreach ($files as $k => $value) {
	# code...
	require $prefix.$value.".".$extension[1];

}


?>