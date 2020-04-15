<?php
@define('SECURE',$_POST);

$Auth_data=array();

$emailposition="";
$passposition="";

function successlogin($tablename,$data,$buffer=false,$set="")
{

	$subjectstr="";

	global $emailposition;
	global $passposition;
	
	$subjectstr=strval(getcolname($tablename));
	

	$temp_cols_array=explode(",",$subjectstr);
	
	#print_r($temp_cols_array);



	#logic to find email column in the Database

	$i=0;
	foreach ($temp_cols_array as $key => $value) {
		
		if(preg_match("/email/", $value)):
			$emailposition=$i;
			break;
		endif;
	$i++;
	}

	#logic to find pass columns name
	$i=0;
	foreach ($temp_cols_array as $key => $value) {
		
		if(preg_match("/pass/", $value)  or preg_match("/pwd/", $value)):
			$passposition=$i;
			break;
		endif;
	$i++;
	}



	#echo $emailposition;
	$colname1=$temp_cols_array[$emailposition];
	
	#echo $colname1;

	$colname2=$temp_cols_array[$passposition];
	
	#echo $colname2;


	$passcolumns="";

	$colsarray=['*'];

	global $Auth_data;

	foreach($data as $key => $values){

			array_push($Auth_data,$values);
	}
	
	#print_r($Auth_data);

	$matchedto=[

		$colname1 => $Auth_data[0],
		$colname2  => $Auth_data[1],
	];
	
	$user_available=selectonly($tablename, $colsarray, $matchedto);

	$islogin=$user_available[0];

	if($islogin>0):
		#include 'auth-mode.php';

		$auth['status']=true;
		$auth['mode']=auth_mode($buffer,$set);
		$auth['authtoken']=$Auth_data[0];
		
	else:
		$auth['status']=false;
	endif;
	return $auth;
	

	

}//end of successlogin



?>