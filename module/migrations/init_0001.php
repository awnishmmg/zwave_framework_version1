<?php 


$GLOBALS["sql"]=[
		"create table tbl_admin(
		id int primary key auto_increment,
		admin_name varchar(100),
		useremail varchar(100),
		password varchar(100),
		tbl_date datetime not null default current_timestamp
		)",
		"create table tbl_urlmapping(
			id int primary key auto_increment,
			filename varchar(100),
			filetype varchar(100),
			status varchar(30),
			rootname varchar(100),
			date datetime not null default current_timestamp
			)"

		];

$authmsg[]="Creating Migration....$a \n TBL_ADMIN COMMITTED OK";
$authmsg[]="Creating Migration....$a \n TBL_URLMAPPING COMMITTED OK";

?>