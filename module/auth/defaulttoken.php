<?php

$dirlist=scandir("module/");
$i=0;
$pos="";


foreach($dirlist as $key => $value){

	if(preg_match("/sess/", $value)){
		$pos=$i;
		break;
	}

$i++;

}

#echo $pos;

$result=$dirlist[$pos];


#echo $result;

#echo $_SERVER['DOCUMENT_ROOT'];

$root=explode('\\',__DIR__);

$mainroot=$root[count($root)-2];

#echo $mainroot;


function getdefaulttoken(){

	global $result;
	#echo $result;
	global $mainroot;

	$filepath="$mainroot/$result";

	if(file_exists("$filepath/session.log")):
		echo "session Generated where file exist<br/>";

	$fp1=fopen("$filepath/session.log","w");

	else:
	echo "file does not exist";

	endif;
	
	

	$prefix="usr";

	$x1=rand(0,9);
	$x2=rand(0,9);
	$x3=rand(0,9);
	$x4=rand(0,9);
	$x5=rand(0,9);

	$suffix="qichtxw";

	$tokenkey=$prefix."$x1$x2$x3$x4$x5".$suffix;

	fwrite($fp1,$tokenkey);

	fclose($fp1);

	$fp2=fopen("$filepath/session.log",'r');

	$salt=15-5;
	
	$sessionvar=fread($fp2,$salt);
	fclose($fp2);
	
	return $sessionvar;




}//end of default token


?>