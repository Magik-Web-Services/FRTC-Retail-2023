<?
include("_header-admin.php")
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" height="255" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F8F8F8">
  <tr>
    <td align="center" valign="middle" bgcolor="#F8F8F8"><p class="form_definitions"><br>
        <h2><?
		$registrationemail22 = "broadcaster@liveplayhouse.com";
			include('../dbase.php');include('../settings.php');
	$month=date("n");
	$year=date("Y");
	$endDate=mktime (0,0,0,22,$month,$year);
 	mysql_query("UPDATE videosessions SET paid='1' WHERE model='$_POST[username]' AND paid!='1' AND date<'$endDate'");
 	mysql_query("UPDATE videosessions_copy SET paid='1' WHERE model='$_POST[username]' AND paid!='1' AND date<'$endDate'");
	echo"Payment was confirmed! ";

	$currentDate=time();
	echo date("d M Y, G:i", $currentDate);
	mysql_query("INSERT INTO payments ( id ,date, ammount , taxes, method , details) VALUES ('$_POST[id]','$currentDate','$_POST[ammount]','0','$_POST[method]','$_POST[info]')");
	
	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";
	$subject="New Payment from $siteurl";
	$message="You have received a new payment.\n\r To view the details of the payment please login and browse to the payments section\r\n $siteurl/broadcaster.php?user=$_POST[username]";
	mail($_POST['email'], $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$registrationemail22\r\n".
     "Reply-To:$registrationemail22\r\n".
     "X-Mailer:PHP/" . phpversion() );
	?></h2>
    </p>
    <p>&nbsp;</p>
    <p><a href="payments.php">Back to Performer Payouts</a>       </p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
