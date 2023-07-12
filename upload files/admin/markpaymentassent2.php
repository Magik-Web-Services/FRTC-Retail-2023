<?
include("_header-admin.php")
?>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eeeeee">
  <tr>
    <td align="center" valign="middle" bgcolor="#FFFFFF"><p class="form_definitions"><br>
	<?
	echo $_POST[username]."<br>";
	include('../dbase.php');
	$month=date("n");
	$year=date("Y");
	$endDate=mktime (0,0,0,22,$month,$year);
 	mysql_query("UPDATE videosessions SET soppaid='1' WHERE sop='$_POST[username]' AND soppaid='0' AND date<'$endDate'");
 	mysql_query("UPDATE videosessions_copy SET soppaid='1' WHERE sop='$_POST[username]' AND soppaid='0' AND date<'$endDate'");
	echo"Payment was confirmed! ";

	//insertion in payments table
	$currentDate=time();
	echo date("d M Y, G:i", $currentDate);
	mysql_query("INSERT INTO payments ( id ,date, ammount , taxes, method , details) VALUES ('$_POST[id]','$currentDate','$_POST[ammount]','0','$_POST[method]','$_POST[info]')");
	
	//mail sending
	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";
	$subject="New Payment from $siteurl";
	$message="You have recieved a new payment.\n\r To view the details of the payment please login and browse to the payments section\r\n $siteurl/login.php?user=$_POST[username]";
	@mail($_POST['Email'], $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$registrationemail\r\n".
     "Reply-To:$registrationemail\r\n".
     "X-Mailer:PHP/" . phpversion() );
	?>	
    </p>
    <p>&nbsp;      </p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
