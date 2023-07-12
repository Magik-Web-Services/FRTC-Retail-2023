<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><style type="text/css">
<!--
body {

}
-->
</style></head>



<style type="text/css">
<!--
.style1 {
	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif
}
body,td,th {
	color: #666666;
	background:#fff;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #1E78AE; }
-->
</style>
<div align="center">
  <p>&nbsp;</p>
  <h3 class="style1">&nbsp;</h3>
  <h3 class="style1">&nbsp;</h3>
  <h3 class="style1">&nbsp;</h3>
  <h3 class="style1"><img src="images/500.gif" width="30%" /></h3>
</div>
<?
include("dbase.php");

include("settings.php");
/*echo "<pre>";
print_r($_COOKIE);
*/
if ($_COOKIE['usertype']=="chatmodels")
{

	
	$resultdata = mysql_query("SELECT * FROM chatmodels where id='".$_COOKIE['id']."'");
	$rowdata = mysql_fetch_array($resultdata); 
} else if ($_COOKIE['usertype']=="chatusers"){

	
	$resultdata = mysql_query("SELECT * FROM chatusers where id='".$_COOKIE['id']."'");
	$rowdata = mysql_fetch_array($resultdata); 
}
//echo "delete FROM user_logged_in where user='".$rowdata['user']."' AND logged_in='yes'";



setcookie("username", "loggedOut", time()-3600);

setcookie("usertype",  "loggedOut", time()-3600);

setcookie("id", "loggedOut", time()-3600);

echo "<META HTTP-EQUIV=\"Refresh\"
CONTENT=\"5; URL=index.php\">";



session_start();
session_destroy();

?>





