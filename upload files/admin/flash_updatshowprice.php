<?
include("../dbase.php");
include("../settings.php");
$price=$_GET["price"]
$string=$_GET["string"];
mysql_query("UPDATE modelshows SET price='$price' WHERE string = '$string' LIMIT 1");
?>