<?php

$sessionmode[0]='session:client';
$sessionmode[1]='session:localfile';
$sessionmode[2]='session:localstorage';
$sessionmode[3]='session:database';



for($i=0;$i<count($sessionmode);$i++)
{
	define("TYPE_".$i, $sessionmode[$i]); #Global Keywords
}

function auth_mode($buffer,$set=""){


	if($buffer==true):
		
		echo "<h3>Available Setting for Session in Auth Module </h3>";
		echo "<hr>";
		
		echo "<b>Root File Name :</b> ".basename($_SERVER['PHP_SELF'],".php");
		echo "<br/>";
		echo "<textarea rows='7' cols='165' style='background-color:powderblue;font-weight:bold;font-size:1.0rem;resize:none;' readonly>";
		foreach (get_defined_constants() as $key => $value):

				if(preg_match("/^TYPE_[0-9]{1}$/",$key)):

						echo $key."=".$value;
						echo "\n";
					else:
						continue;
				endif;
		
		endforeach;	
		echo "</textarea>";
		echo "<hr/>";

	endif;

	if($set=="")
		return TYPE_0;
	else 
		return $set;
}


?>