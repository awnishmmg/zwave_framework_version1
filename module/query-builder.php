<?php
define('MODE_1',$_GET); 					#to Handle Get Request
define('MODE_2',$_POST); 					#to handle Post Request
define('MODE_ALL',$_REQUEST); 				#to handle Automatic Either GET OR POST

include 'dbconnect.php';
include 'schema.php';
#INSERT FUNCTION READY

function insert($tablename,$data)
{
	global $con;
	$data['date']=date('d-m-Y');

	$values=implode("','",$data);

	$sql="";
	$sql.="Insert into $tablename values(NULL,'$values')";
	
	$check=mysqli_query($con,$sql);
	if($check==true):

		return true;

	else:
		echo "Insert Error".mysqli_error($con);
	endif;

}

#Delete Function Ready
function delete($tablename,$id){

	global $con;

	$col_name=getcolname($tablename);
	

	$colarr=explode(",",$col_name);
	$sql="";
	$sql.="Delete from $tablename where $colarr[0]";
	$sql.="='".$id."'";

	#echo $sql;

	$check=mysqli_query($con,$sql);

	if($check==true):
		return true;
	else:
		echo "Delete Error".mysqli_error($con);
	endif;

}

#delete multiple
function multidelete($tablename,array $idarray)
{
	
global $con;

	$col_name=getcolname($tablename);
	
	$list=implode("','",$idarray);

	$colarr=explode(",",$col_name);
	$sql="";
	$sql.="Delete from $tablename where $colarr[0] in ('$list')";

	#echo $sql;

	$check=mysqli_query($con,$sql);

	if($check):
		return true;
	else:
		echo "Delete Error".mysqli_error($con);
	endif;

	
}

#this for update

function update($tablename,array $data,array $matchedto){
global $con;

$str="";

	foreach($data as $keys => $values):

		$str=$str.$keys."="."'".$values."',";

	endforeach;
	$newstr=substr($str,0,-1);

	$sql="";
	$sql.="Update $tablename set $newstr where ";
	$cond="";

	$len=count($matchedto);

	if($len==1):

		foreach ($matchedto as $key => $value):
		$cond=$key."="."'".$value."'";

		endforeach;	

	else:

			foreach ($matchedto as $key => $value):

				$cond=$cond.$key."="."'".$value."' and ";

			endforeach;

			$cond=substr($cond,0,-4);
	endif;//end of else 


	$sql.=$cond;

	//echo $sql;


	$check=mysqli_query($con,$sql);
	
	if($check):
		return true;
	else:
		echo "Update Error".mysqli_error($con);

	endif;

	
}//end of update

#for select *
function select($tablename){

global $con;

$sql="";

$sql="Select * from $tablename";

$res=mysqli_query($con,$sql);

$data=array();

$col_name=getcolname($tablename);
$cols=explode(",",$col_name);
$size=count($cols);

while($row=mysqli_fetch_array($res,MYSQLI_BOTH)){
/*
for($i=0;$i<$size;$i++)
{

	$data[]=$row[$i];
}
*/
$data[]=$row;

}

return $data;

} //only end of selectall



function selectonly($tablename,array $colsarray,array $matchedto){

global $con;

$str="";

	foreach($colsarray as $keys => $values):

		$str.=$values.",";

	endforeach;

	$newstr=substr($str,0,-1);

	$sql="";
	$sql.="select $newstr from $tablename where ";

	$cond="";

	$len=count($matchedto);

	if($len==1):

		foreach ($matchedto as $key => $value):
		$cond=$key."="."'".$value."'";

		endforeach;	

	else:

			foreach ($matchedto as $key => $value):

				$cond=$cond.$key."="."'".$value."' and ";

			endforeach;

			$cond=substr($cond,0,-4);
	endif;//end of else 


	$sql.=$cond;

	#echo $sql;

	$datainfo=array();

	$res=mysqli_query($con,$sql);
	$dbcount=mysqli_num_rows($res);

	$sizeofcols=count($colsarray);

	if($dbcount>0):

		while($row=mysqli_fetch_array($res,MYSQLI_BOTH)):

			
			for($i=0;$i<$sizeofcols;$i++):

				$datainfo[]=$row[$i];
			endfor;
			
			/*$datainfo[]=$row;*/

		endwhile;
		return $datainfo;
	else:
		echo "No record Exist : Data ";
		return [0];
	endif;


}//end of select only function

/*
How to Use the Function Anywhere
foreach (select('std_info') as $index => $row) {
	
	echo $row;
	echo "<br/>";


}
*/
#insert to a specific columns 

function insertat($tablename,array $coldata)
{

	global $con;

	$columns=implode(",",array_keys($coldata));
	$values=implode("','",array_values($coldata));

	$sql="";
	$sql.="Insert into $tablename($columns) values('".$values."')";
	
	#echo $sql;

	$check=mysqli_query($con,$sql);
	if($check=true):
		
		return true;
	else:
		return false;
	endif;


}//end of insert-at 

function securelogin(){
	//this is abstract method with implementation but no definition
}#//end of secure login

function create_demotable(Table $tableobj){

	//this is abstract method with implementation but no definition
}

function form_helper(){

		//this is abstract method with implementation but no definition
}


function smart_toast($action,$type,$msg){
	//this is abstract method with implementation but no definition

}


function crud_handler(){
	//this is abstract method with implementation but no definition
	//Important method to handle crud-related Task
}
#Donot Try to Handle this Request
require 'pagehandler.php';

?>