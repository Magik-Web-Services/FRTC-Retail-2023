<?php
include('dbase.php');
if($_REQUEST["usertype"]=='chatusers'){
$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='".$_REQUEST['id']."' LIMIT 1");
$rslt = mysql_fetch_array($result);
//echo "<pre>"; print_r($rslt['user']); echo "</pre>";
$sender_name = $rslt['user'];
$members = $_REQUEST['members'];
$performers = $_REQUEST['performers'];
$message = $_REQUEST['get_messages'];
$dttime = date("Y-m-d H:i:s");
//echo "INSERT INTO users_models_message set member_id='$members', broadcast_id='$performers', message='$message', sender_id='$id', send_time='$dttime'";
mysql_query("INSERT INTO users_models_message set member_id='$members', broadcast_id='$performers', message='$message', sender_id='$sender_name', send_time='$dttime'");
}

if($_REQUEST["usertype"]=='chatmodels'){
	$performers = $_REQUEST['members'];
	$message = $_REQUEST['get_messages'];
	$dttime = date("Y-m-d H:i:s");
	//echo "<pre>"; print_r($_REQUEST); echo "</pre>";
	mysql_query("INSERT INTO users_models_message set member_id='0', broadcast_id='$performers', message='$message', sender_id='$performers', send_time='$dttime'");
}
?>