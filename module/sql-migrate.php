<?php

$GLOBALS['mastersql']=array();

function sqlmigrate(){
	global $con;


	$dbtools_arr=userfunclist('table_setup.php');
	foreach ($dbtools_arr as $key => $value) {
		
		$filename=md5($value);
		include "db_tables/{$filename}.php";
		$sql="CREATE TABLE {$tablename}(";
		$fields="";
		foreach($schema as $fieldname => $datatype){
			$fields.=trim($fieldname.$datatype,"\n\r ").",";
		}

		$fields=substr($fields, 0,-1);
		$MASTER_QUERY=$sql.$fields.");";
		$GLOBALS['mastersql'][]=$MASTER_QUERY;
	}

	$sqlarr=$GLOBALS['mastersql'];
	echo "\n sql migration sync successful please wait" ;
	$lists=scandir('db_tables/');
	unset($lists[0],$lists[1]);
	$x=1;
	foreach($lists as $key => $value){
		echo "\n SQL Migration $x file name ".basename($value,".php");
		sleep(2);
		$x++;
	}
	sleep(3);
	echo "\n found ".count($dbtools_arr)." Migrations to be made";
	sleep(2);
	echo "\n connecting to MSQL server ....";
	sleep(1);
	echo "\n connection set-up OK";

	foreach ($sqlarr as $key => $query) {
			echo "\n \t ".$query;
			if(!mysqli_query($con,$query)){
				echo "\n ".mysqli_error($con);
				exit;
			}
			else{
				sleep(2);
				echo "\n \t Query ".($key+1)."executed successfully \n";
			}
		}	

		echo "# Database tables created successfully\n";
}


?>