<?

if(isset($_POST['accountUser']) && isset($_POST['accountPassword']))

{

	

include("dbase.php");

include("settings.php");

	if ($_POST['accountType']=="member")

	{

	$database="chatusers";

	} else if ($_POST['accountType']=="model")

	{

	$database="chatmodels";



	} else if ($_POST['accountType']=="studioop")

	{

	$database="chatoperators";

	}

	

	

	$userExists=false;

	$result = mysql_query("SELECT id,user,password,status FROM $database WHERE status!='pending' AND status!='' ");

	while($row = mysql_fetch_array($result)) 

	{

		$tempUser=$row["user"];

		$tempPass=$row["password"];

		$tempId=$row["id"];

		

		if ($_POST['accountUser']==$tempUser && md5($_POST['accountPassword'])==$tempPass)

		{

			if ($row["status"]=="blocked")

			{

			$userExists=true;

			$errorMsg="Account is blocked, please contact the administrator for more details";

			} else {

			

			$userExists=true;

			$currentTime=time();

			mysql_query("UPDATE $database SET lastLogIn='$currentTime' WHERE id = '$tempId' LIMIT 1");

			setcookie("usertype", $database, time()+3600);

			setcookie("id", $tempId, time()+3600);

			header("Location: cp/$database/");

			}

		}

	

	}

	if (!$userExists){

	$errorMsg="Wrong Username or password, Having trouble logging in? Try reseting your password.";

	}

	

	

} else if (isset($_GET['from']) && $_GET['from']=="recoverpass"){

	$errorMsg="Your new password has been sent to your mail";

} else {

	$errorMsg="Please complete username and password fields";

}


include("_main.header.php");
?><style type="text/css">
<!--
body,td,th {
	color: #FFFFFF;
}
body {
	background-color: #000000;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12px;
}
a:link {
	color: #99CC00;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #99CC00;
}
a:hover {
	text-decoration: none;
	color: #99FF00;
}
a:active {
	text-decoration: none;
	color: #99CC00;
}
-->
</style>

<table width="720" height="191" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td align="center" valign="middle" bgcolor="#333333"><form action="login.php" method="post" enctype="application/x-www-form-urlencoded" name="form1">

      <p>&nbsp;</p>

      <table width="720" border="0" align="center" bgcolor="#333333">

        <tr>

          <td colspan="2"><p align="left"><span class="error"><?php if ( isset($errorMsg) && $errorMsg!=""){ echo $errorMsg; } ?></span>

              </p>
            <p align="left"><br>
              
              <br>
              
            </p></td>

        </tr>

        <tr>

          <td width="210" align="right" valign="top" class="form_definitions"><div align="right">Username:</div></td>

          <td align="left" valign="top"><input name="accountUser" type="text" id="accountUser" value="<? echo $_GET[user];?>" size="24" maxlength="24"></td>

          </tr>

        <tr>

          <td align="right" valign="top" class="form_definitions"><div align="right">Password:</div></td>

          <td align="left" valign="top"><input name="accountPassword" type="password" id="accountPassword2" size="24" maxlength="24"></td>

          </tr>

        <tr>

          <td align="right" valign="top" class="form_definitions"><div align="right">Account type:</div></td>

          <td align="left" valign="top">

              <select name="accountType" id="select">

                <option value="member" selected>Member</option>

                <option value="model">Model</option>

                <option value="studioop">Studio Operator</option>

              </select>            <div align="left"></div></td>

          </tr>

        <tr>

          <td align="right" valign="top" class="form_definitions">&nbsp;</td>

          <td align="left" valign="top">

            <input type="submit" name="Submit" value=" Log In to your account">            <div align="left"></div></td>

          </tr>

        <tr>

          <td align="right" valign="top" class="form_definitions">&nbsp;</td>

          <td align="left" valign="top"><p><a href="lostpassword.php" class="left style1">Click Here! to reset your password.</a></p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></td>
<?
include("_main.footer.php");
?>
          </tr>

      </table>

    </form></td>

  </tr>

</table>


