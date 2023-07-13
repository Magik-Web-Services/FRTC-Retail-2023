<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<div align="center">
	<p>&nbsp;</p>
	<h3 class="style1">&nbsp;</h3>
	<h3 class="style1">&nbsp;</h3>
	<h3 class="style1">&nbsp;</h3>
	<h3 class="style1"><img src="images/500.gif" width="30%" /></h3>
</div>
<?php
include("dbase.php");

include("settings.php");
if ($_COOKIE['usertype'] == "chatmodels") {


	$resultdata = mysqli_query($conn, "SELECT * FROM chatmodels where id='" . $_COOKIE['id'] . "'");
	$rowdata = mysqli_fetch_array($resultdata);
} else if ($_COOKIE['usertype'] == "chatusers") {


	$resultdata = mysqli_query($conn, "SELECT * FROM chatusers where id='" . $_COOKIE['id'] . "'");
	$rowdata = mysqli_fetch_array($resultdata);
}
//echo "delete FROM user_logged_in where user='".$rowdata['user']."' AND logged_in='yes'";



setcookie("username", "loggedOut", time() - 3600);

setcookie("usertype",  "loggedOut", time() - 3600);

setcookie("id", "loggedOut", time() - 3600);

echo "<META HTTP-EQUIV=\"Refresh\"
CONTENT=\"5; URL=index.php\">";



session_start();
session_destroy();

?>