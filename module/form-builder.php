<?php
include 'form-tool/form_input.php';	

$input_type=array();
$input_name=array();

function modelform($action,$submit,$tbname,$sep=''){
	global $input_type;
	global $input_name;

	$filename=md5($tbname);
	include "module/db_tables/{$filename}.php";
	#echo $tablename;
	$data_types=$schema;
	$fields=[];



	foreach ($data_types as $dkey => $dvalue) {
		$fields[]=$dvalue;
		$input_name[]=$dkey;
	}
		unset($fields[0],$fields[count($fields)]);
		
		
		foreach ($fields as $key => $typesvalue) {
			if(preg_match("/varch/", $typesvalue)){
				$input_type[$tablename."_".$input_name[$key]]='text';
		}
		else{
			$input_type[$tablename."_".$input_name[$key]]='number';
		}

		}
		$formbody="";

		$formopen='<form action="'.$action.'" method="post" enctype="multipart/form-data">';
		$formopen.="\n";
		$formopen.="<table>\n";
			foreach ($input_type as $name => $type) {
				$labelname=substr($name,strlen($tablename)+1);
				$formbody.='<tr><td><label for="id_'.$name.'">Enter Your '.ucwords($labelname).' :</label></td>'."\n";
				$formbody.=' <td><input type="'.$type.'" name="'.$name.'" class="class_'.'input'.'" id="id_'.$name.'"/>'."$sep"."</td></tr>\n";
				
			}
		
		$form_submit='<tr><td><input type="submit" value="'.$submit.'" name="submit" /></td></tr><br/>';
		$form_submit.="</table>\n";
		$formclose='</form>';

		$code=$formopen.$formbody.$form_submit.$formclose;
		echo $code;
}















