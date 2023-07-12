<?php
if(!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatmodels" )
{
header("location: ../../login.php");
}
else
{
include("../../dbase.php");
$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");
while($row = mysql_fetch_array($result)) 

	{	$username=$row[user];	}

$filename="../../models/".$username."/thumbnail.jpg";
$result = file_put_contents( $filename, file_get_contents('php://input') );
if($result)
echo "1";
else
echo "0";
}
?>


