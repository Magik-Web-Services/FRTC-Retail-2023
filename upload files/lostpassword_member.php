<?

if($_POST[accountUser]!="")

{

	include("dbase.php");

include("settings.php");

	if ($_POST['accountType']=="member")

	{

	$database="chatusers";

	} else if ($_POST['accountType']=="model")

	{

	$database="chatmodels";



	} else if ($_POST['accountType']=="studioOp")

	{

	$database="chatoperators";

	}

	

	

	$userExists=false;

	$result = mysql_query("SELECT user,email,id FROM $database WHERE status!='pending' && status!='rejected'");

	while($row = mysql_fetch_array($result))

	{

		$tempUser=$row["user"];

		$tempEmail=$row["email"];

		$tempId=$row["id"];

		

		if ($_POST['accountUser']==$tempUser){

			$userExists=true;

			function makeRandomPassword() { 

        	  $salt = "abchefghjkmnpqrstuvwxyz0123456789"; 

	          srand((double)microtime()*1000000); 

	          $i = 0; 

	          while ($i <= 7) { 

	                $num = rand() % 33; 

	                $tmp = substr($salt, $num, 1); 

	                $pass = $pass . $tmp; 

	                $i++; 

    	      } 

        	 return $pass; 

    	}

		$random_password = makeRandomPassword(); 

    	$db_password = md5($random_password); 



		mysql_query("UPDATE $database SET password='$db_password' WHERE id = '$tempId' LIMIT 1");

		

$subject = "New password for $siteurl account"; 	   		

$charset = "Content-type: text/plain; charset=iso-8859-1\r\n";

$message = "

Your password has been reset. 

     

New Password: $random_password 

	 	

$siteurl/login.php 




This is an automated response, please do not reply!";
	

@mail($tempEmail, $subject, $message,

"MIME-Version: 1.0\r\n".

$charset.

"From:$registrationemail\r\n".

"Reply-To:$registrationemail\r\n".

"X-Mailer:PHP/" . phpversion() );

		

header("Location: login_member.php?from=recoverpass");

exit();

		

		}

	

	}

	$errorMsg="Username does not exists";

	

	

} else

{

	$errorMsg="";

}



?>



<?
include("_main.header.php");
?><style type="text/css">
<!--

select{color:#ffffff}  
select{background-color:#333333}



input{color:#ffffff}  
input{background-color:#333333}
input{border-color: black black}


body {
	background-color: #8F0000;
}
body,td,th {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
a {
	font-size: 11px;
	color: #FFFFFF;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: none;
	color: #FFCC00;
}
a:active {
	text-decoration: none;
	color: #FFCC00;
}
#Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 12px;
	top: -116px;
}
.style2 {font-size: 12}
.style3 {font-size: 12px}
-->
</style>

<table width="720" height="200" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td align="center" valign="middle"><form action="lostpassword.php" method="post" enctype="application/x-www-form-urlencoded" name="form1">
      <table width="600" height="88" border="0" align="center" background="images/password_reset_bg.png">

        <tr>

          <td colspan="3"><p align="left"><br>

              <br>

</p></td>
        </tr>

        <tr>

          <td width="90" align="right" valign="top" class="form_definitions">&nbsp;</td>

          <td width="424" align="left" valign="top"><p align="left">

              <span class="style3">Username:</span>&nbsp;&nbsp;
              <input name="accountUser" type="text" id="accountUser" size="24" maxlength="24">

          &nbsp;&nbsp;<input type="submit" name="Submit" value="Get New Password" /></p></td>

          <td width="72" align="left" valign="top" class="form_informations"><div align="left">
            
          </div></td>
        </tr>

        <tr>

          <td colspan="3" align="right" valign="top" class="form_definitions"><div align="right"></div>            
          <div align="left"></div></td>
          </tr>
      </table>

      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><br />
            <span class="style2">A new password will be created and emailed to the email address you have on file with us. You can change your password at any time by logging in and visiting the &quot;My Profile&quot; link from your control panel. </span></td>
        </tr>
      </table>
      <br />
      <p><span class="error">
        <?php if ( isset($errorMsg) && $errorMsg!=""){ echo $errorMsg; } ?>
      </span></p>
    </form></td>

  </tr>

</table>

<div id="Layer1">
  <select name="accountType" id="select">
              <option value="member" selected="selected">Member</option>
              <option value="model">Model</option>
</select></div>
<br>

<?
include("_main.footer.php");
?>

