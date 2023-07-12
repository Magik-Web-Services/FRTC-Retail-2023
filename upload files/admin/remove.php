<?
include("_header-admin.php")
?>
<table width="720" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eeeeee">
  <tr>
    <td bgcolor="#FFFFFF">	
	<?
	include('../dbase.php');
	$sum=$_POST[usd]*100+$_POST[cents];
	$sum2=$sum/100;
	mysql_query("UPDATE chatusers SET money=money-'$sum' WHERE user = '$_POST[user]' LIMIT 1");
	
	@mail($_POST[email], "Money Removed from deposit","$sum2 have been removed from your Virtual Wallet account./n $siteurl/login.php", "From:$registrationemail\r\n"."Reply-To:$registrationemail\r\n");
	
	echo "Money ahve been removed and a mail has been sent to the member letting him know of this deposit.";
	?>
	
	<table width="700" align="center">
      <tr>
        <td>&nbsp;</td>
        </tr>
    </table>		</td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
