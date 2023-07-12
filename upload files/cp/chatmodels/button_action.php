<?php
include("../../dbase.php");
if($_REQUEST['action']=="accept"){
mysql_query("UPDATE chatmodels SET Spy_Shows='yes' where id='$_COOKIE[id]'");
}else if($_REQUEST['action']=="close_chat"){
mysql_query("UPDATE chatmodels SET Spy_Shows='no' where id='$_COOKIE[id]'");	
}
?>