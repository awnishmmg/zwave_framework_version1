<?php

@session_start();

function getsessid(){


	$fp2=fopen("module/session_token_dir/session.log",'r');

	$salt=15-5;
	$sessid=fread($fp2,$salt);
	#echo $sessid;
	$GLOBALS['sessid'] =$sessid;

	fclose($fp2);
}

function main(){

getsessid();#calling of sessid()

}
main();

function getauthtoken(){

	$sessid=$GLOBALS['sessid'];

	$usertoken=$_SESSION[$sessid];
	return $usertoken;
}


?>