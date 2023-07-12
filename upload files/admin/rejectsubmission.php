<?
error_reporting(0);
include("_header-admin.php");
?>




<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td width="1010" bgcolor="#F8F8F8">	
	  <div align="center">
	    <p>
	      <br />
        </p>
	    <p>&nbsp;</p>
	    <p>
	      <?
	include('../dbase.php');include ("../settings.php");
	$registrationemailbroad ="broadcaster@liveplayhouse.com";
	//mysql_query("UPDATE chatmodels SET status='rejected' WHERE id = '$_POST[id]' LIMIT 1");
mysql_query('DELETE from modelpictures WHERE user="'.$_POST['username'].'"');
mysql_query('DELETE from chatmodels WHERE user="'.$_POST['username'].'"');
mysql_query('DELETE from favorites WHERE model="'.$_POST['username'].'"');
	
$dir="../models/".$_POST[username]."/";
$files=scandir($dir);
foreach($files as $file)
{
if(strlen($file)>2)
{
unlink($dir.$file);
}
}
rmdir($dir);

	mail($_POST[email], "Your submission at $siteurl was rejected", "Your application for becoming a webcam broadcaster has not been approved.\r\n Reason: $_POST[Reason]",
     "MIME-Version: 1.0\r\n".
     "Content-type: text/plain; charset=iso-8859-1\r\n".
     "From:$registrationemailbroad\r\n".
     "Reply-To?:$registrationemailbroad\r\n".
     "X-Mailer: PHP/" . phpversion() );

	if ($_POST[owner]!='none'){
	$result3=mysql_query("SELECT email FROM chatoperators WHERE user='$_POST[owner]' LIMIT 1");
			//while($row3 = mysql_fetch_array($result3)) {
			//$tOwnerEmail=$row3[email];
			}
			
	mail($tOwnerEmail, "Your model submission at $siteurl was rejected", "Your broadcaster  application for becoming a webcam broadcaster has not been approved.\r\n Reason: $_POST[reason]",
     "MIME-Version: 1.0\r\n".
     "Content-type: text/plain; charset=iso-8859-1\r\n".
     "From:$registrationemailbroad\r\n".
     "Reply-To:$registrationemailbroad\r\n".
     "X-Mailer: PHP/" . phpversion() );
	 
	
	//}
	
	echo"Model Rejected";
	
	?>
        </p>
	  </div>
	  <table width="1010" height="157" align="center" bgcolor="#F8F8F8">
      <tr>
        <td><div align="center"><a href="index.php">Back to Admin Panel </a></div></td>
        </tr>
    </table>		
      <div align="center"></div>
    <div align="center"></div></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>