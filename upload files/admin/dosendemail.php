<?
include("_header-admin.php")
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eeeeee">
  <tr>
    <td bgcolor="#F8F8F8"><br>
	<table width="1010" height="329"  border="0" align="center" bgcolor="#F8F8F8">
      <tr>
        <td class="big_title"><div align="center">
          <p><h1>Email sent to <? echo $_POST['email'];?></h1></p>
          <p><a href="<? if($_POST['type']=="model"){echo"modelviewdetails";} else if ($_POST['type']=="member"){echo"memberviewdetails";} else if ($_POST['type']=="sop"){echo"sopviewdetails";}?>.php?id=<? echo $_POST['id'];?>">Now ,get me back!</a><br>
                <br>
                <?
include('../dbase.php');
include('../settings.php');

$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
@mail($email, $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$newsletteremail\r\n".
     "Reply-To:$newsletteremail\r\n".
     "X-Mailer:PHP/" . phpversion() 
);

?>
                <br>
              </p>
        </div>
          <p>&nbsp;</p>
          <p>&nbsp;</p></td>
        </tr>
    </table>	
	</td>
  </tr>
</table>

<?
include("_footer-admin.php")
?>
