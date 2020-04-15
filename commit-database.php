<?php

$action="action=create-database-wxz12079wZKJH457HQQU56789IUHHB67890RGHHXCEXCTC";
# this file is responsible for creating a database if does not exist
$uri=$_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  /* background-color: black; */
  background-color:#3333;
  
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
  width:600px;
  margin:0px auto;
  box-shadow:0px 0px 10px black;
}

/* Full-width input fields */
input[type=text], input[type=password],select {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
select:focus, input[type=password]:focus {
  background-color: white;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: blue;
}
label{
    display:block;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<?php
$host_info=explode(":",$_SERVER['HTTP_HOST']);

$hostname=$host_info[0];
$portno=$host_info[1];

?>
  <?php

$dbx=[];
$a=isset($_GET['attempt'])?$_GET['attempt']:0;

if(isset($_POST['dbsubmit'])){
    unset($_POST['dbsubmit']);
    
    foreach($_POST as $key => $value):
        if($value=="__BLANK__"){
            $dbx[]="";
        }
        else{
            $dbx[]=$value;
        }
        
        echo "<br/>";
    endforeach;

    $dbhost=$dbx[0];
    $dbuser=$dbx[1];
    $dbpass=$dbx[2];
    $dbname=$dbx[3];
    $dbport=$dbx[4];

    @$conn=mysqli_connect($dbhost,$dbuser,$dbpass);
    if($conn){ 
        
        $sql="CREATE DATABASE IF NOT EXISTS $dbname";
        if(!mysqli_query($conn,$sql)){
            die();
            exit;
        }
    #########################################################################
    ######################| code for dbconnection file |##############
    $code="";
    $code.="<?php";
    $code.="\n";
    $code.="#Host name for the Connecting with the mysqlserver";
    $code.='$db["driver_name"]="MYSQL"';
    $code.="\n";
    $code.='$db["sqli"]="true"; #use of sqli instead of sql is recommended';
    $code.="\n";
    $code.='$db["host"]="'.$dbhost.'"; #use of host-name';
    $code.="\n";
    $code.='$db["user"]="'.$dbuser.'"; #userName for Connection with Database Engine';
    $code.="\n";
    $code.='$db["pass"]="'.$dbpass.'"; #password for the Connection with the Database';
    $code.="\n";
    $code.='$db["db"]="'.$dbname.'"; #db name is Important if database is not avaliable the we need to create Database;';
    $code.="\n";
    $code.="\n";
    $code.="\n";
    $code.="\n";
    $code.="\n";
    $code.="?>";
    #########################################################################
    ######################| End of code for dbconnection file |##############

    $fptr=fopen("module/db_init/__init__.php","w");
    fwrite($fptr,$code);
    fclose($fptr);
    echo "<script>alert('database Created successfully');window.location.href='home'</script>";    
    }
    else{
        $msg="";
        $status=1;

    }
}
?>

    <form action="<?php echo $action."?attempt=$a";?>" method="post">
  <div class="container">
    <?php

    if($a>=3){
        die("<h3>Your maximum attempts expired!!</h3> 
        <hr/><samp style='font-size:16px;'>For further assitance contact awnishkumar at <b>+91-8299502081</b> or mail at <b>awnishmmg.a41@gmail.com</b></samp>");
    }
    if(isset($status)){
        die("<span style='color:red;'><b>Invalid Hostname or credentials</span><a href='".$action."?attempt=".($a+1)."'> try Again ? </a></b>");
    }

    ?>
    <h1><samp>Set Up Database Configuration</samp></h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Hostname *</b></label> <samp style="color:red;">Donot change if root is default username </samp>
    <input type="text" placeholder="Database Hostname" name="hostname" value="<?php echo $hostname; ?>" required/>

    <label for="email"><b>TargetDb username *</b></label> <samp style="color:red;">Donot change if root is default username </samp>
    <input type="text" placeholder="Database username" name="username" value="root" required>
   
    <label for="psw"><b>Password</b></label>
    <samp style="color:red;">Donot change if root is default __Blank__ for empty Password </samp>
    <input type="text" placeholder="Database Password" name="password" value="__BLANK__" required>

    <label for="psw-repeat"><b>Database name</b></label>
    <input type="text" placeholder="Database name" name="dbname" required>
    
    <label><b>Port No</b> [default] </label>
    <select name="mysql_port">
    <option value="">choose</option>
    <option value="3306" selected>default 3306/3307 Driver mysql</option>
    <option value="3308">default 3306 Driver posgrel</option>
    <option value="1322">default 3306 Driver mariadb</option>
    <option value="1380">default 3306 Driver Oracle</option>
    <option value="144277">default 3306 Driver mongodb</option>
    </select>
    <hr>
    <p><b><samp>click below to finally set connection with your target machine(Server)</samp></b></p>
    <button type="submit" class="registerbtn" name="dbsubmit">SET UP Connection >></button>
  </div>


</form>

</body>


</html>
