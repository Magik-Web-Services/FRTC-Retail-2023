<? 
//connection to the database
include("dbase.php");
include("settings.php");
$now=time();
mysql_query("INSERT INTO favorites ( member , model , dateadded ) VALUES ('$_GET[member]', '$_GET[model]', '$now')");

?>