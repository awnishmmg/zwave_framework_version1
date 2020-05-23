<?php
define('SAFEMODE',true);

#########################| This is code related to server port |#######################

$PORT_PATH="module/port";

$portfptr=fopen("$PORT_PATH/running-port.php","r+");
$portno=$_SERVER['SERVER_PORT'];
$code="<?php \n";
$code.='$portno=';
$code.="$portno";
$code.="\n ?>";
fwrite($portfptr,$code);

#########################| This is code relatted to server port |#####################


$safemode=isset($_GET['safemode'])?$_GET['safemode']:"";
if($safemode!=""){
	echo "Illegal switch <br/>";
}
else if($safemode=="true"){

	$fptr=fopen("module/auth/debugmode.dat",'w');
	$modestr="[debugmode]=true";
	fwrite($fptr,$modestr);
	fclose($fptr);
}
else if($safemode=="false"){
	$fptr=fopen("module/auth/debugmode.dat",'w');
	$modestr="[debugmode]=false";
	fwrite($fptr,$modestr);
	fclose($fptr);
}

$fptr=fopen("module/auth/debugmode.dat",'r');
$getdebugdata=trim(fread($fptr,20));

#echo "<b>".$getdebugdata."</b><br/>";
$filedebug=explode("=",$getdebugdata);


$getversion=phpversion();
#echo $getversion;
$versionx=$getversion;

$phpversion=explode(".","".$versionx);

if($phpversion[0]<7){

	die('<center><samp style="color:red;font-weight:bold;font-type:italic;">Oops You running Older Version of PHP please Ugrade to Latest</samp></center>');
	exit();
}

#if($getversion>)
#Here You need to define Those Pages you wanna Open without Session

$debugmode=trim($filedebug[1]);
#echo $debugmode;

include 'module/.safe/safemode_ini.php';

fclose($fptr);

include 'module/file_ini/file_ini.php';
include 'module/templates/includes.php';

#--------------------------------------------------------------

if(SAFEMODE==$debugmode)
	echo '<samp style="background-color:yellow;">@safe Mode<span style="color:red;"> Enabled</span></samp><br/>';

function securesessid(){


	$fp3=fopen("module/session_token_dir/session.log",'r');

	$salt=15-5;
	$sessid=fread($fp3,$salt);
	#echo $sessid;
	$GLOBALS['authid'] =$sessid;

	fclose($fp3);
}
securesessid();
$AUTHID=islogin();

function islogin(){
$AUTHID=$GLOBALS['authid'];
return $AUTHID;
}

session_start();

@$sessionparam=$_SESSION[$AUTHID];


$currentpage=basename($_SERVER['PHP_SELF'],".php");
#echo $currentpage;
if((in_array($currentpage,$allowpage))){
}
else
{
	
	if($sessionparam=="")
	{
			header("location:$landingpage.php");
	}
	
}





include 'module/form-builder.php';


?>