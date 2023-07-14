<?php
include("dbase.php");
if($_COOKIE['usertype']=="chatusers"){
$userid = $_COOKIE['id'];
$modlnm = $_REQUEST['modelname'];
$usrnm = $_REQUEST['useramme'];

mysqli_query($conn, "UPDATE chatmodels SET Spy_Shows='no' WHERE user='$modlnm'");
die;
}
if($_COOKIE['usertype']=="chatmodels"){
$userid = $_COOKIE['id'];
mysqli_query($conn, "UPDATE chatmodels SET Spy_Shows='no' WHERE id='$userid'");
die;
}

?>