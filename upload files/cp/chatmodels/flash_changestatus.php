<?
include("../../dbase.php");
$seconds=30;
$currentTime=time();
$nom=$_GET['numberofmembers']-1;
mysql_query("UPDATE chatmodels SET onlinemembers='$nom',lastupdate='$currentTime', status='$_GET[sStatus]' WHERE id = '$_GET[sId]' AND status!='blocked' LIMIT 1");
?>