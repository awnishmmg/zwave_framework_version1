<?php

#echo "configuration loaded <br/>";

$script_name=basename($_SERVER['PHP_SELF']);

#loadcss  using anonymous functions
$stylesheets=function(){

$ASSETS_PATH="module/templates/assets/";

$ASSETS_cssdir=scandir($ASSETS_PATH."css/");


foreach($ASSETS_cssdir as $key => $values):

	if(in_array($values,[".",".."])):
		continue;
	
	endif;
			$realfilepath="module/templates/assets/css/$values";
			
			$version=filemtime($realfilepath);

	echo '<link href="module/templates/assets/css/'.$values.'?version='.$version.'" type="text/css" rel="stylesheet"/>';
	echo "\n    ";

endforeach;


};  //these function are like $variable hence they need to be terminated

##############################################################################################

##################### Function to Load Images Automatically ##################################

##############################################################################################

$loadimg=function($imagename,$height="40px",$width="40px"){

return '<img src="module/templates/assets/images/'.$imagename.'" style="height:'.$height.';width:'.$width.';cursor:help;" title="By default size of image , is 40px X 40px  respectively to change just pass $height and $width as arguments in function. eg $loadimg(imagename,height,width) ." />';

};





###################################################################################################

# *************************** for Mainting the UI- Of the Page we are Designing *******************

###################################################################################################
#echo $script_name;

switch($script_name):
	
	case 'login.php':

		$title="Signup or Login here";
		$header_content="Secure Login";
		$data="";
		break;

	case 'Dashboard.php':
		$title="welcome to Dashboard";
		$header_content="User Dashboard";
		$data="";
		break;

	default: 
		
		$title="Softpro PTD";
		$header_content="SPI PTD";
		$data="";
		break;
endswitch;



####################################################################################################

#******************************* Code for loading all the Scripts automatically *****************

####################################################################################################

$initautoloading=function(){

	global $autoloadfooter;

if($autoloadfooter==true):
	die();
endif;

};

###################################################################################################

$initautoloading();  ####### | Donot try to Interfere with this file

##################################################################################################





$scripts=function(){

$ASSETS_jsdir=scandir("module/templates/assets/js/");
foreach($ASSETS_jsdir as $key => $values):

	if(in_array($values,[".",".."])):
		continue;
	
	endif;

	echo '<script src="module/templates/assets/js/'.$values.'" type="text/javascript">
	</script>';
	echo "\n    ";
endforeach;


 }; //these function are like $variable hence they need to be terminated






?>