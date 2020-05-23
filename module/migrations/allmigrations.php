<?php

#wap in php to implement manage.php  -create-admin

$commands[0]='-makemigrations';
$commands[1]='-create-admin';
$commands[2]='-migrate';
$commands[3]='-delete-migrations';
$commands[4]='-build-panel/manager';
$commands[5]='-applyplugins';
$commands[6]='-openpanel';
$commands[7]='-run-adminpackage';
$commands[8]='-load-adminpackage';
$commands[9]='-show/dbtools';
$commands[10]='-requestcode';
$commands[11]='-commit-models';
$commands[12]='-sqlmigrate';
$commands[13]='-help';

###################################| Make Migration Here |##############################

###################################| Make Migrations Here |##############################

$authmsg=array();
$status=0;
$GLOBALS['sql']=array();

$a=1;

function makemigrations(){

global $authmsg;
global $con;
global $status;
global $a;
#create the Admin Table

	$sql1="SELECT * FROM tbl_admin";
	$res1=mysqli_query($con,$sql1);
	@$count1=mysqli_num_rows($res1);
	if($count1>0):
		echo "-# migration already committed \n ";
		$status++;
	else:
		
		$status=0;
		$fptr=fopen("migrations/init_0001.php",'w');
		$code="<?php \n\n\n";

		// define the table schema

		$code.='$GLOBALS["sql"]=[
		"create table tbl_admin(
		id int primary key auto_increment,
		admin_name varchar(100),
		useremail varchar(100),
		password varchar(100),
		tbl_date datetime not null default current_timestamp
		)",
		"create table tbl_urlmapping(
			id int primary key auto_increment,
			filename varchar(100),
			filetype varchar(100),
			status varchar(30),
			rootname varchar(100),
			date datetime not null default current_timestamp
			)"

		];';

		// ########################################################

		$code.="\n\n";
		// also assign the $authmsg for each table-schema in migrations

		$code.='$authmsg[]="Creating Migration....$a \n TBL_ADMIN COMMITTED OK";';
		$code.="\n";
		$code.='$authmsg[]="Creating Migration....$a \n TBL_URLMAPPING COMMITTED OK";';
		$code.="\n\n?>";

		fwrite($fptr,$code);
		fclose($fptr);

		
		echo "\n Migration Set Up Successfully  \n <path location> \n | \n |-----init_0001.php \n";
	endif;

}	//end of the make migrations functions


function migrate()
{

global $authmsg;
global $con;
global $status;
global $a;

if(file_exists('migrations/init_0001.php')){
	include 'init_0001.php';
}
else{

	die("\n No migrations possible.");
}//end


$sql=$GLOBALS['sql'];
#print_r($sql);
	foreach($sql as $key => $value){
		echo "\n".$value."\n";
		if(mysqli_query($con,$value)){
			echo "\n Query Executed \n";
			sleep(3);
		}
	}
	foreach($authmsg as $key => $value){
	echo "\n".$value;
	$a++;
}

echo " \t [RESPONSE]Superuser can now created.\n";
}//end of if

?>