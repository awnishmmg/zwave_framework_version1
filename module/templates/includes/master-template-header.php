<?php
include 'module/templates/get_settings.php';
?>

<!DOCTYPE html>
<html>
<head lang="Us-en">
	<title>:: <?php echo $title;  ?> ::</title>

	<?php $stylesheets(); ?>
	<?php

		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		
	?>

</head>
<body>
	<div id="outer">
	<header>
		<div id="header">
			<center>
				<h1><?php echo $header_content; ?></h1>
			</center>	

		</div>
	</header>	
	<main>
		<div id="main">
<!-- Header Template To be Loaded Automatically -->



	
