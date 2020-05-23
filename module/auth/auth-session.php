<?php


function authmanager($authmode,$authtoken,$session_varname=""){

	if($session_varname==""):

		$session_varname=getdefaulttoken();
	
	endif;

	$typearr=explode(":",$authmode);
	$mode=$typearr[1];
	
	#way of calling the functions

	/*
	$var="$mode";

	$var();
	*/

	/*
	call_user_func($mode);
	*/

#calling the function itself

eval($mode($authtoken,$session_varname));

}//end of session Manager


function client($authtoken,$session_varname){

	#echo "Auth Token : $authtoken ";
	#echo "<br/>";
	echo "Session Token : $session_varname ";

	$_SESSION[$session_varname]=$authtoken;

}

function localfile(){
	
	echo "local file function is running";

}

function localstorage(){

	echo "Local Storage function is Now Running";
}
function database(){

	echo "Database function are running";

}



?>