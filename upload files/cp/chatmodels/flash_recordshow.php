<?
include("../../dbase.php");
mysql_query("INSERT INTO modelshows (user, name, string, previewtime, movietime) VALUES ('$_GET[model]', '$_GET[name]', '$_GET[string]','$_GET[previewtime]','$_GET[movietime]')");
?>