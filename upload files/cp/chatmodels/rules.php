<? if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatmodels" )

{

header("location: ../../login.php");

} else{

include("../../dbase.php");

$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];	}

}

mysql_free_result($result);

?>

<?
include("_models.header.php");
?>

<table width="720" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr align="center" valign="middle">

    <td height="113"><br>      <table width="80%"  border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td align="left" valign="top"><p class="form_definitions"><b>Rule Number 1 </b><br> 

        The money displayed in the broadcast interface window are the ammount of money you deducted from the member. these money are divided between the site and you according to the epercentages set by the admin. Studio operators recieve a fix sum of 10%. </p>

          <p class="form_definitions"><strong>Rule Number 2 <br>

          </strong>Once a member requests a private chat you are automatically sent toa private chat rom, the other users still are in your public room and they will see you when you get back.</p>

          <p class="form_definitions"><strong>Rule Number 3<br>

          </strong>this is another important rule: You shoud respect your clients!</p>

          </td>

      </tr>

      <tr>

        <td align="left" valign="top">&nbsp;</td>

      </tr>

    </table>    <p class="form_definitions"><br>

    </p>

    </td></tr>

</table>

<?
include("_models.footer.php");
?>