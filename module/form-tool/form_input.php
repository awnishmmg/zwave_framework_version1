<?php
$action=isset($_GET['action'])?$_GET['action']:"";

define('TOAST',$action);
require 'Form_library/class.form.php';

#function for sweet alert

function toast($type,$msg=""){

$msg=isset($msg)?$msg:"";

	$status=isset($_GET['status'])?$_GET['status']:"";
	if(strtolower($status)=='default'){
		$status=" ";
	}

		$status=ucwords($status);
		$status=explode("-", $status);
		$status=implode(" ", $status);

	switch ($type) {
		case 'error':
			$bgcolor="red";
			break;
		case 'success':
			$bgcolor="lightgreen";
			break;
		case 'default':
				$bgcolor="cyan";
			break;
		case 'ready':
			$bgcolor="orange";
			break;
		default:
				$bgcolor='cyan';
				break;
	}

	if(!empty($status)){

	$width=(270+strlen($status))."px";

		echo "<div id='sweet_alert' style='box-shadow:0px 0px 5px black;margin:0px auto;min-height:30px;text-align:center;width:$width;background-color:$bgcolor;border-radius:3px;z-index:9999;line-height:25px;border:1px solid grey;margin-bottom:8px;font-family:arial;font-size:0.8rem;color:black;font-weight:bold;text-shadow:0px 0px 10px white;'>{$status} {$msg}</div>";
		echo "<script>";
		echo "setTimeout(function(){
		var sweetobj=document.getElementById('sweet_alert');
		sweetobj.style.display='none';
		},3000);";
		echo "</script>";
	}


}//end sweet_alert//

#Inbuilt default in status
#Inbuilt Get Request action and status

function smart_toast($action,$type,$msg=''){
	$gettype=TOAST;
	
if(isset($gettype) and $gettype=="{$action}"):
	toast($type,$msg);
endif;
}


?>