<?php


#table details of the database

include 'dbconnect.php';

$res=mysqli_query($con, "SHOW TABLES");

$i=1;

echo "<center><h3>List of Tables in Database ".DB."</h3><hr/>";
while($row=mysqli_fetch_assoc($res)):

		$param='Tables_in_'.DB;

		$tablename=$row[$param];


		echo "$i : ",$tablename;
		echo "<hr/>";
		
		

		#echo 'define('.strtoupper($TABLEALIAS).','.$tablename.')';


	//define("tab-".$a,$row[]);
$i++;

endwhile;
echo "</center>";

?>