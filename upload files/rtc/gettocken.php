<?php

include("../dbase.php");

$musername = $_GET['username'];



 if($musername == 'Me'){
	
	//print_r($_COOKIE['id']);
	
	$id =$_COOKIE['id'];
	
	$resltt = mysql_query("SELECT money FROM chatusers  WHERE  id='$id'");		
	
	$data =	mysql_fetch_array($resltt);
	
	echo $data['money'];
	
	}else{

	$resltt = mysql_query("SELECT money FROM chatusers  WHERE  user='$musername'");		
	$data =	mysql_fetch_array($resltt);
	
	echo $data['money'];

	}	
die();


 ?>
