<? 
//connection to the database
include("dbase.php");
include("settings.php");
$now=time();
if ($_GET['timeremaining']!=0){
	mysql_query("UPDATE chatusers SET freetime='$_GET[timeremaining]', freetimeexpired='0' WHERE user='$_GET[member]' LIMIT 1");
	} else {
	mysql_query("UPDATE chatusers SET freetime='$_GET[timeremaining]', freetimeexpired='$now' WHERE user='$_GET[member]' LIMIT 1");
	}
	
	
?>