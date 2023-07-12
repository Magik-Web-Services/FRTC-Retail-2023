<?
include("_main.header.php");
?><style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FFFFFF;
}
body {
	background-color: #000000;
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

<table width="720" height="200" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">

  <tr>

    <td align="center" valign="middle"><p>&nbsp;</p>

      <p>&nbsp;</p>

      <table width="600" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="51"><p class="message"> 

          <?

$result=mysql_query("SELECT email,user,password,emailtype,status from chatoperators WHERE id = '$_GET[UID]' LIMIT 1");

while($row = mysql_fetch_array($result)) 

	{

	$email=$row['email'];

	$user=$row['user'];

	$pass=$row['password'];

	$my_pass=$row['password'];

	$db_pass=md5($pass);

	$emailtype=$row['emailtype'];

	$status=$row['status'];

	}

	

if ($status!="pending"){

echo 'This account has already been activated';

} else {

	mysql_query("UPDATE chatoperators SET password='$db_pass', status='active' WHERE id ='$_GET[UID]' LIMIT 1");	

	if ($emailtype=="text"){

	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";

	$message = "Here are your login details for your studio operator account



username:$user

password:$my_pass



You can access the login page at: 

$siteurl/login.php?user=$user



The Webmaster 

This is an automated response, please do not reply!";



	} else if($emailtype=="html"){



	$charset="Content-type: text/html; charset=iso-8859-1\r\n";

	$message = "Here are your login details for your member account



username:$user

password:$my_pass



You can access the login page at: 



<a href='$siteurl/login.php?user=$user'>$siteurl/login.php?user=$user</a>



The Webmaster 

This is an automated response, please do not reply!";



	}else{

	echo"Email variable not set";

	}



$subject = "Your login information at $siteurl"; 



mail($email, $subject, $message,

     "MIME-Version: 1.0\r\n".

     $charset.

     "From:$registrationemail\r\n".

     "Reply-To:$registrationemail\r\n".

     "X-Mailer: PHP/" . phpversion() );



echo 'Your operator account has just been activated.';

}

?>

        </p></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

    </table>

    <p>&nbsp;</p>

    <p>&nbsp;</p></td>

  </tr>

</table>
<?
include("_main.footer.php");
?>
