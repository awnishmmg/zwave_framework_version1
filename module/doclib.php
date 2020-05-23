<?php

$option=$argv[1];

function encryptlib($lib_datfile){
	$hash=md5($lib_datfile);
	rename("php_lib/{$lib_datfile}.dat","php_lib/{$hash}.dat");
}

encryptlib($option);

?>