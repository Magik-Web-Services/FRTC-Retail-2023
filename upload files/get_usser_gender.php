<?php
include("dbase.php");
if($_COOKIE['usertype']=="chatmodels"){
$get_username = $_REQUEST['get_username'];
$result = mysqli_query($conn, "SELECT gender from chatusers where user='$get_username'");
$rows = mysqli_fetch_array($result);
echo $rows['gender'];
die;
}
?>