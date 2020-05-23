<?php

define('INCLUDES_BASEPATH','module/templates/includes/');

$templatedir=scandir(INCLUDES_BASEPATH);

include 'module/auth/restrict-pages.php';

foreach ($templatedir as $key => $value):
	if(in_array($value,$donotscan)):
		continue;
	else:
		include INCLUDES_BASEPATH.$value;
	endif;

endforeach;

?>