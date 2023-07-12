<?php
include("dbase.php");
if($_COOKIE['usertype']=="chatmodels"){
$get_username = $_REQUEST['get_username'];
$result = mysql_query("SELECT gender from chatusers where user='$get_username'");
$rows = mysql_fetch_array($result);
echo $rows['gender'];
die;
}
?>