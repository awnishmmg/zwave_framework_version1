<?php
	
	function filereader($start,$readfromfile,$targetfile,$end=""){	
	$fptr=fopen($targetfile,'w');		

	$dataarr=file($readfromfile);
	
	if($end=="")
	$max=count($dataarr);
	else
		$max=$end;
	
	for($i=$start;$i<$max;$i++){

			fwrite($fptr,$dataarr[$i]);
			
	}
	fclose($fptr);
	return;
}//end of filereader


function execute($basepath=''){
require 'list.php';

if($basepath=="")
	$location="";
else
	$location=$basepath;

	$realpath =	"panel-manager/".$FILESOURCE;
$maxsize=count(file($realpath));


for($i=0;$i<$maxsize;$i++)
{
		if($i==0):
				filereader($i,$realpath,"$location/".$files[0],6);
		elseif($i==6):
				filereader($i,$realpath,"$location/".$files[1],48);
		elseif($i==48):
				filereader($i,$realpath,"$location/".$files[2],114);		
		elseif($i==114):
				filereader($i,$realpath,"$location/".$files[3],216);
		elseif($i==216):
				filereader($i,$realpath,"$location/".$files[4]);
	endif;
}


} //end of execute function



	
	
?>