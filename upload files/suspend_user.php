<?php
include("dbase.php");
//echo "<pre>"; print_r($_COOKIE);
if($_REQUEST['kickTime']=="5"){
$model = $_REQUEST['model'];
$member = $_REQUEST['member'];
mysql_query("INSERT INTO user_kick set member_id='$member', broadcast_id='$model',  status='Forever'");

}else{
$time = $_REQUEST['kickTime'];
$model = $_REQUEST['model'];
$member = $_REQUEST['member'];
//$correct_time = date("H:i:s", strtotime("+$time hours"));	
$correct_time =date("Y-m-d H:i:s", strtotime("+$time hours"));	
mysql_query("INSERT INTO user_kick set member_id='$member', broadcast_id='$model', kick_time='$correct_time', status='sometime'");

}

?>