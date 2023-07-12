<?
include("_header-admin.php")
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" height="303" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#eeeeee">
  <tr>
    <td bgcolor="#FBFBFB"><p>&nbsp;</p>
      <table width="600"  border="0" align="center">
      <tr>
        <td class="big_title"><div align="center"><h2>Your news letter has been sent...</h2> <br>
            <br>
          <?

include('../dbase.php');
include('../settings.php');
if($_POST['members1']=="true"){
echo '<span class="big_title">Free Acess Members</span><br><span class="form_informations">(';
$result=mysql_query('SELECT email,user from chatusers WHERE money<=0');
while($row = mysql_fetch_array($result)) 
	{	
	$email=$row['email'];
	$user=$row['user'];
	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	@mail($email, $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$newsletteremail\r\n".
     "Reply-To:$newsletteremail\r\n".
     "X-Mailer:PHP/" . phpversion() );
	 
	 echo " $user,";
	}
	echo")</span><br>";

}

if($_POST['members2']=="true"){
echo '<span class="big_title">Paying Members</span><br><span class="form_informations">(';
$result=mysql_query('SELECT email,user from chatusers WHERE money>0');
while($row = mysql_fetch_array($result)) 
	{	
	$email=$row['email'];	
	$user=$row['user'];
	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	@mail($email, $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$newsletteremail\r\n".
     "Reply-To:'$newsletteremail'\r\n".
     "X-Mailer:PHP/" . phpversion() );
	echo " $user,";
	}
	echo")</span><br>";


}
if($_POST['models']=="true"){
echo '<span class="big_title">Models</span><br><span class="form_informations">(';
$result=mysql_query('SELECT email,user from chatmodels WHERE status!="rejected" AND status!="pending"');
while($row = mysql_fetch_array($result)) 
	{	
	$email=$row['email'];	
	$user=$row['user'];
	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	mail($email, $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$newsletteremail\r\n".
     "Reply-To:$newsletteremail\r\n".
     "X-Mailer:PHP/" . phpversion() );
	echo " $user,";
	}
	echo")</span><br>";


}

if($_POST['sop']=="true"){
echo '<span class="big_title">Studio Operators</span><br><span class="form_informations">(';
$result=mysql_query('SELECT email,user from chatoperators');
while($row = mysql_fetch_array($result)) 
	{	
	$email=$row['email'];
	$user=$row['user'];
	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";
	$subject=$_POST['subject'];
	$message=$_POST['message'];
	mail($email, $subject, $message,
     "MIME-Version: 1.0\r\n".
     $charset.
     "From:$newsletteremail\r\n".
     "Reply-To:$newsletteremail\r\n".
     "X-Mailer:PHP/" . phpversion() );
	echo " $user,";
	}
	echo")</span><br>";


}

?>
          <br>
        </div></td>
        </tr>
    </table>	
	<p>&nbsp;</p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
