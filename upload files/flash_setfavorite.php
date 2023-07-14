<?php 
//connection to the database
include("dbase.php");
include("settings.php");
$now=time();
mysqli_query($conn, "INSERT INTO favorites ( member , model , dateadded ) VALUES ('$_GET[member]', '$_GET[model]', '$now')");

?>