<? 
//connection to the database
include("../../dbase.php");
mysql_query("DELETE from modelshows WHERE string='$_GET[string]'");
?>