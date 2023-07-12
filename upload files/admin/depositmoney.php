<?
include("_header-admin.php")
?>


<style type="text/css">
<!--

.selector
{
  background-image: url();
  background-color: #FFFFFF;
  
  position: fixed;
  
  top: 0;
  left: 0;
  width: 100%;
  height: 50px;
  z-index: 10;

}
-->

</style>





<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
  <tr>
    <td bgcolor="#ffffff">	
	<table width="1010" height="300" align="center" class="form_definitions">
      <tr>
        <td align="center" valign="middle" bgcolor="#EFEFEF"><b><?
	include('../dbase.php');
	include('../settings.php');
	$sum=$_POST[cents];
	//$sum2=$sum;
	mysql_query("UPDATE chatusers SET money=money+'$sum' WHERE user = '$_POST[username]' LIMIT 1");

	mail($_POST['email'], "Tokens credited to your account", "$sum tokens have been credited to your account.\r\n \r\n You may login and view your account at the following URL:\r\n\r\n $siteurl/login_member.php?user=$_POST[username] \r\n",
     "MIME-Version: 1.0\r\n".
     "Content-type: text/plain; charset=iso-8859-1\r\n".
     "From:$registrationemail\r\n".
     "Reply-To:$registrationemail\r\n".
     "X-Mailer: PHP/" . phpversion() );
	
	echo "Funds have been added successfully.";
	?></b>
          <br>
          <br>
          <a href="memberviewdetails.php?id=<?php echo $_POST[id];?>" class="a_left"><b>Back to <?php echo $_POST[username] ?>'s account</b></a> </td>
        </tr>
    </table>		</td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
