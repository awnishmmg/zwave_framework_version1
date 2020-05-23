<?php

require 'dbconnect.php';


function getcolname($tablename){

	global $con;

	$columns=array();

	$res=mysqli_query($con,"Desc $tablename");
	while($row=mysqli_fetch_assoc($res)):

		array_push($columns,$row['Field']);
		//echo $columns;

	endwhile;
	return implode(",",$columns);


} 




?>