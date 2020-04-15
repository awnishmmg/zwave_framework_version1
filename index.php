<?php

#database page address
$url=$_SERVER['PHP_SELF'];
$baseuri=basename($url);
################################################################################


if(file_exists('module/db_init/__init__.php')){
#set the landing page name
	$page="home";	
}
else{
	$page="action=create-database-wxz12079wZKJH457HQQU56789IUHHB67890RGHHXCEXCTC";
}

###############################################################################

#echo $baseuri;

switch ($baseuri):

	case 'index.php':
	header("location:$page");
	break;

	default:
		echo "<h1>REQUESTED PAGE NOT FOUND</h1>";
		break;

endswitch;
#exit;
?>