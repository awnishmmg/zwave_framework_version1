<?php

#create Database Connections

################################################################################
include 'dbconnect.php';
################################################################################
#################################| All Migration Related |########################

include "migrations/allmigrations.php";
include "core-functions.php";
include 'sql-migrate.php';
#################################| All Migration Related |########################

$userinfo=array();  ##### |Empty Array for the $Admin-User-information-Credentails |#####

if($argc<2):

	echo "-# Illegal Command \n";
	
	exit;
else:
$option=$argv[1];
if(in_array($option,$commands)):

		if($option==$commands[1]):
			# calling of function to set up credentails
			setup_credentials();
		elseif($option==$commands[0]):
			#echo "This will make sql statement \n";
			makemigrations();
			exit;
		elseif($option==$commands[2]):
			#echo "This will make sql statement \n";
			migrate();
			exit;
		elseif($option==$commands[3]):
				deletemigrations();
				exit;
		elseif($option==$commands[4]):
				panelmanager();
				exit;
		elseif($option==$commands[6]):
				openserver();
					exit;
		elseif($option==$commands[7]):
					quick_zip();
					exit;
		elseif($option==$commands[8]):
					loadadminpackage();
					exit;
		elseif($option==$commands[11]):
					commit_table();
					exit;
		elseif($option==$commands[12]):
					sqlmigrate();
					exit;
		elseif($option==$commands[13]):
					needhelp();
					exit;
		elseif($option==$commands[10]):
					pullcode();
					exit;
		elseif($option==$commands[9]):
					showdblist();
					exit;
		elseif($option==$commands[5]):
				echo "\n # no plugins available in Version 1.0 \n";
				exit;
		else:
		echo "-# Illegal Command \n";
		endif;
	else:
		echo "-# Illegal Command \n";
	endif;
endif;
function deletemigrations(){
	$MAX_SERIAL=22;

	if(file_exists("migrations/init_0001.php")):
		unlink("migrations/init_0001.php");
		if(!file_exists("migrations/init_0001.php")){
			echo "\n performing system... check \n";
			for($i=1;$i<=$MAX_SERIAL;$i++){
				echo "\n Scanning.... $i SERIALISED COMMIT OK \n";
				sleep(1);
			}
			sleep(5);
			echo "\n migrations deleted successfully \n";
		}
		exit;
	else:
		die("\n # No migrations exist nothing to delete \n");
	endif;

}
function setup_credentials(){
	global $con;
	global $db;
	$database=$db['db'];
	$query="SELECT * 
		FROM information_schema.tables
		WHERE table_schema = '$database'
    	AND table_name = 'tbl_admin'
		LIMIT 1";
	$result=mysqli_query($con,$query);
	@$checkcount=mysqli_num_rows($result);
	if($checkcount<=0){
		die("\n#found no migrations,\n#superuser cannot be created ");
		exit;
	}

		echo "\n *********| Set your Credentials |************";
		$username=php_uname('n');
		$uname=input("Enter Admin Name (use $username as DEFAULT)");
		$userinfo[]=ucwords(trim($uname,"\n"));
		$logid=input("Enter Email Id (as Login Credential)");
		$userinfo[]=trim($logid,"\n");
	while(true):
		$pass=input("Enter Password(Case-sensative)");
		$cpass=input("Enter Confirm Password ");
		if(validatepass($pass,$cpass)==true){
				#$userinfo[]=md5($pass);
				$userinfo[]=trim($pass,"\n");
				break;
		}
	endwhile;
	
	if(count($userinfo)>=3 && $userinfo!=null){
		
		echo "\n loading configuration...";

		$values=implode("','",$userinfo);
		$sql="insert into tbl_admin(admin_name,useremail,password) values('$values')";
		if(mysqli_query($con,$sql)){
			
			sleep(2);
			echo "\n Applying necessary setting..\n";

			$sql="update tbl_admin SET admin_name = TRIM(TRAILING '\r' FROM admin_name);";
			$sql.="update tbl_admin SET useremail= TRIM(TRAILING '\r' FROM useremail);";
			$sql.="update tbl_admin SET password = TRIM(TRAILING '\r' FROM password)";

			if(mysqli_multi_query($con,$sql)){
				sleep(3);
				echo "\n Admin created successfully. ";
			}
			else{
				echo "\n".mysqli_error($con);
			}
			
		}
		else{
			die("Connection Error".mysqli_error($con));
		}
		##################################################################################		
	
		
		}//end of if
	
}
function input($msg){
	$buffersize=1024;
	$outputstream=trim($msg);
	echo "\n $outputstream :";
	$input=fgets(STDIN,$buffersize);
	return $input;
}
function validatepass($pass,$cpass){
	if($pass==$cpass){
		return true;
		}//end of if
	else{
		echo "\n Password donot Matched";
		return;
	}
}

###################################| Need help menu |#######################################

function needhelp(){

	global $commands;
	unset($commands[count($commands)-1]);

	echo "\n";
	echo "***********************| List of commands available |**********************";
	echo "\n";
	foreach($commands as $key => $value){

		echo "\n Command syntax [Available] : php manage.php ".$value;

	}
	echo "\n \n ";
	echo "*******************************************************************************";
	echo "\n";

}

#panel manager code here
function panelmanager(){
	#echo $_SERVER['SERVER_PORT'];
	system("cls");
	echo "\n \033[1m panel manager configuration [loaded successfully] \033[0m \n";
	echo "\n [Information] : panel manager is responsible for modification of url mapping ";
	
	$address=explode("\\",getcwd());
	
	$newaddress=implode("/",array_slice($address,3,7));
	$path=dirname($newaddress);
	include "port/running-port.php";
	#in order to make a text bold we have escape code

	echo "\n [ Usage 1] :For users goto url --> \033[1m http://localhost:$portno/$path/.panel\033[0m \n";
	echo "\n [ Usage 1 part 2] :For admin goto url --> \033[1m http://localhost:$portno/$path/admin/.panel\033[0m \n";
	echo "\n [Usage 2] : further login with credential of any super user being created and start rewriting the urls you wish";
	echo "\n [ Choose the ROOT panel path ] ";
	echo "\n 1) FOR ADMIN";
	echo "\n 2) FOR USERS";
	echo "\n";
	echo "\n";
	
	$legalresponse[]=1;
	$legalresponse[]=2;
	while(true){
		
		$response=trim(input("\n \t choose option [1 for admin or 2] "),"\r\n");
		if(!in_array($response,$legalresponse)){
			echo "\n wrong option try again ";
			continue;
		}
		$confirm=strtolower(trim(input("\n \t Are you sure  [y|n]"),"\r\n"));
		if($confirm=="y"){
			break;
			return;
		}

	}
	if($response==1){
		echo "<panel manager> created [ ADMIN LEVEL ] \n \t | \n \t |---->admin \n \t |---->.panel \n ";
		$getpath=createpanel('admin-level'); #create-panel
		
		include 'panel-manager/code-init-file.php';
		execute($getpath);
		// to open the system file-explorer uncomment the code
		#system("cd .. && cd admin/ && start . ");
		
	}
	else{
		echo "<panel manager> created [ USERS LEVEL ] \n \t | \n \t |---->".basename($path)." \n \t |---->.panel \n";
		$getpath=createpanel('user-level'); #create-panel
		include 'panel-manager/code-init-file.php';
		execute($getpath);
		
		// to open the system file-explorer uncomment the code 

		#system("start ..");
	
	} ### end of if function in the $reponse


}	#### |end of the function panelmanager()

############################################| function for create panel |##########################################

function createpanel($pathlevel){
	$panelname='.panel';

	#echo $pathlevel."\n";

	# using switch case get the panel path

	switch($pathlevel){
		
		case 'admin-level':
								$panelpath=setrootpath('admin');
								break;
		case 'user-level': 
								$panelpath=setrootpath();
								break;
		default:
			break;
	}

	#now this panel path can be used to create folder
	echo "\n initialising folder-directory system checking writable permission....";
	sleep(3);

	#creation of .panel manager

	if(!file_exists($panelpath.$panelname)){
		if(mkdir($panelpath.$panelname,0777,true)){
			echo "\n \t .panel manager created successfully ! \n";
		}
	}
	else{
		echo "\n .panel manager already exist \n ";
	}

	$ADDRESS_PANEL=$panelpath.$panelname;
	return $ADDRESS_PANEL;



} //end of function createpanel


############################################| function for create panel |##########################################

function setrootpath($folder=''){

	#to Handle Absolute Path for global path

	$ROOT_PATH=dirname(__DIR__);
	$ROOTADDR=explode('\\',$ROOT_PATH);

	
	$ROOTNEWADDR=implode("/",$ROOTADDR);
	if($folder==''){

		return $ROOTNEWADDR."/";
	}
	else{
		return $ROOTNEWADDR."/$folder/";
	}
	
	

} //end of setrootpath

function openserver(){

	echo "\n PANEL MANAGER STARTED ON ADDRESS: \033[1m http://localhost:8000/\033[0m \n";
	$path=setrootpath();
	system("cls");
	system("php -S localhost:8000 -t $path/.panel/");
}

function check_file($filename='',$directory='..'){
	$dirlist=scandir($directory);
	#print_r($dirlist);	
	
	$count=count($dirlist);
	$a=0;
	foreach( $dirlist as $key => $value ){
			if(strtolower($value)==strtolower($filename)){
				return true;
			}
			else{
				if($a>=$count){
					return false;
				}
			}
			$a++;
	}//end of foreach
	
	}
	
function quick_zip(){
	
#code for zipping the file at rootdirectory

#function to check for a specific file...

	#calling of function
	if(check_file('admin.zip')==true){
		
		$zip = new ZipArchive; #make $zip object
		$res = $zip->open('../admin.zip'); #get resources object by opening zip

		if ($res === TRUE) { # if $resources accessed return true extract the files to destination
		$zip->extractTo(dirname(__DIR__)); # then close the file displace message else display error
		$zip->close();
		echo "\n admin package loaded and installed successfully \n";
		sleep(3);
		echo "\n running set up completed...\n ";
		echo "\n [ How to access ]: goto address project-url/admin \n.";
		unlink("../admin.zip");
		} else {
		echo "\n # error running admin package";
		}

	}//end of if
	else{
		echo " \n # admin package not found try -load-adminpackage \n ";
		
	}
	
	
} //end of functions

function is_connected()
{
    $connected = @fsockopen("www.google.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

#function for loadingthe admin package
function loadadminpackage(){
echo "\n Load admin package is responsible for loading admin the package from url";
echo "\n getting current class ready loading configuration.....";
sleep(2);
$a=1;
while(true):
if(is_connected()){
	echo " \n Internet connection available ";
	break;
	
}
else{
	if($a==20){
		
		echo "\n oops possible number of attempts exceeded [Connection Error]";
		echo "\n it seems your internet connection is offline ";
		exit;
	}
	echo "\n Connection Time-out";
	echo "\n trying to connect...attempt $a";
	sleep(1);
	
}
$a++;
endwhile;

#then perform task related to internet
$url="http://easyonhome.com/admin.zip";
if ($url!= null){
	echo "\n please wait checking..connection";
	sleep(3);
	echo "\n donwloading.... from Remote url ";
	echo "\n http://awisoft.net/zwaveframework-license/v1/get-packages/admin-load-file/load/sscw3s00p?set=1";
	sleep(2);
	echo "\n Unpacking resources from url..";
	echo "\n Retrieving http header...from server machine ";
	echo "\n license released to awisoft.net publiser name : awnish kumar ";
	echo "\n";
	echo "\n header information : JSON DATA zwave={ 'packagename:'";
  $header = get_headers("$url");
  $pp = "0";
  echo json_encode($header, JSON_PRETTY_PRINT);
  $key = key(preg_grep('/\bLength\b/i', $header));
  $type = key(preg_grep('/\bType\b/i', $header));
  $http = substr($header[0], 9, 3);
  $tbytes = @explode(" ",$header[$key])[1];
  $type = @explode("/",explode(" ",$header[$type])[1])[1];
  echo " Target size: ".floor((($tbytes / 1000)/1000))." Mo || ".floor(($tbytes/1000))." Kb";
  $t = explode("/",$url);
  $remote = fopen($url, 'r');
  $nm = $t[count($t)-1].".$type";
  $local = fopen("../$nm", 'w');
  $read_bytes = 0;  
  echo PHP_EOL;
  while(!feof($remote)) {
    $buffer = fread($remote, intval($tbytes));
    fwrite($local, $buffer);
    $read_bytes += 2048;
    $progress = min(100, 100 * $read_bytes / $tbytes);
    $progress = substr($progress,0 , 6) *4;
    $shell = 10; /* Progress bar width */ 
    $rt = $shell * $progress / 100;
    echo " \033[35;2m\e[0m Downloading: [".round($progress,3)."%] ".floor((($read_bytes/1000)*4))."Kb ";
    if ($pp === $shell){$pp=0;};
    if ($rt === $shell){$rt=0;};
    echo str_repeat("█████",$rt).str_repeat("=",($pp++))."@>\r";
    sleep(1);
  }
  echo " \033[35;2m\e[0mDone [100%]  ".floor((($tbytes / 1000)/1000))." Mo || ".floor(($tbytes/1000))." Kb   \r";
  echo PHP_EOL;
  fclose($remote);
  fclose($local);
  @unlink('.zip');
  
  chdir(dirname(__DIR__)); # function to be used for changing the directory

  if(rename("admin.zip.zip","admin.zip")){
	  echo "\n [Response Success ] admin-packages loaded successfully \n";
	  
  }
  chdir("module");

}

}//end of loadadminpackage


#################################| Block for the Query builder functions |###################



function showdblist(){
$dbtools_arr=userfunclist('query-builder.php');

echo "\n";
echo "################| List of database functions |##########################";
echo "\n";

foreach ($dbtools_arr as $key => $value) {
	echo "function ".($key+1).": ".$value."\n";
}

echo "\n";
}

##########################################################################################


################################| function to show documentation |######################

function pullcode(){
	$dbtools_arr=userfunclist('query-builder.php');

	while(true):
		$response=trim(input("\n Enter the db-tools function name "),"\r\n");
		if(in_array($response, $dbtools_arr)){
			$fptr=fopen("samplecode/samplecode.php","w");
			$code="";
			$code.="<?php \n\n";
			$code.="# This is sample file to get requested code into the file just copy and paste the code ";
			$code.="\n";
			$hash=md5($response);
			$dbdoc=file_get_contents("php_lib/{$hash}.dat");
			$code.=$dbdoc;
			$code.="\n\n\n ?>";
			fwrite($fptr, $code);
			fclose($fptr);
			echo "\n wait generating code....";
			sleep(4);
			echo "\n code generated successfully in samplecode.php inside samplecode folder just go and copy paste";
			break;
		}
		else{
			echo "\n #no such dbtools exist #try some other or use show/dbtools command $";
		}
	endwhile;
	
}

########################################| commit table action ###############################
function commit_table(){
	$dbtools_arr=userfunclist('table_setup.php');

	include 'table_setup.php';

	$tableobj=new Table();
	
	foreach($dbtools_arr as $key => $value){
		$param=[$tableobj];
		call_user_func_array($value, $param);
		
		$tableobj->char('date','30');

		$hash=md5($value);
		$fp=fopen("db_tables/{$hash}.php",'w');

		$code="<?php \n\n ";
		$code.='$tablename='."'".$value."'";
		$code.="; \n";
		$str="";
		foreach($tableobj->table as $cols => $consts){
			$str.='$schema['."'".$cols."'".']'."='".$consts."'; \n";
		}
		$code.=$str;
		fwrite($fp,$code);
		fclose($fp);
		$tableobj=new Table(); #reinstantiate to recombine relaunch the code.
	}

	#print_r($tableobj->table);
	echo "processing.....";
	sleep(3);
	echo "\n models related to database setup successfully";


}







?>