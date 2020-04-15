<?php

#to logout the user
$rootpage=$_SERVER['PHP_SELF'];

function logmeout($pagename,$title){

global $rootpage;
$defaultpage=basename($rootpage);

$php_page=$pagename.".php";

if(file_exists($php_page)):
	goto label;
	echo "<b>it seems $php_page</b> already exist in your project hence cannot generated,<samp><b>Try some other page Name</b></samp>";
else:
	#echo "file Donot Exist";
	$fptr=fopen($php_page,'w+');

	$code="<?php \n ";

	$code.="\n session_destroy();\n";
	#$code.='echo "<script>window.location.replace(';
	#$code.="'index.php')";
	#$code.='</script>"';
	$code.=" header('location:".$defaultpage."'); \n ?> \n";
	
	fwrite($fptr,$code);
	fclose($fptr);
endif;
label:
echo '<a href="'.$php_page.'">'.$title.'</a>';

#session_start();
#session_destroy();
}


?>