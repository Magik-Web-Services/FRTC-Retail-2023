<?php

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

include('../dbase.php');
include('../settings.php');
mysql_query("UPDATE chatmodels SET status = 'offline', Spy_Shows = 'no' WHERE user='".$_REQUEST['username']."'");
mysql_query("delete FROM user_logged_in where user='".$_REQUEST['username']."' AND logged_in='yes'");
echo "https://liveplayhouse.com/admin/modelviewdetails.php?id='".$_REQUEST['id']."'&stts='lgut'";
header("Location: https://liveplayhouse.com/admin/modelviewdetails.php?id='$_REQUEST[id]'&stts='lgut'");

?>



