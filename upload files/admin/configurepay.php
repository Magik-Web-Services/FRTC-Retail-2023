<style type="text/css">
<!--
body,td,th {
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
<?
include("_header-admin.php");
	include('../dbase.php');
if (isset($_POST['txtPaypal'] )!= "")
{
	$sql="Update paymentgate set email = '".$_POST['txtPaypal']."',url = '".$_POST['txturl']."' where code ='1'";
	$res=mysql_query($sql);
}
?>

<form action="" method="POST" onsubmit="return check();">
<table width="720" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#333333">
  <tr>
    <td bgcolor="#333333" class="form_definitions"><p><br>
    <?
    $sql="select email,url from paymentgate where code='1'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
    ?>
Please Enter Paypal Payment Address -<br/> <input type="text" name="txtPaypal" id="txtPaypal" value="<?=$row['email']?>" size="60"/>
    
    </td></tr>
     <tr>
    <td bgcolor="#333333" class="form_definitions"><p><br>
     Please Enter Return URL - <br/><input type="text" name="txturl" id="txturl" value="<?=$row['url']?>" size="60"/>
    
    </td></tr>
    <tr>
      <td bgcolor="#333333" class="form_definitions"><p><br>
<input type="submit" value="Configure" name="btnSubmit"/>
    
    </td>
</tr>
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{
	if (document.getElementById('txtPaypal').value =="")
	{
		alert("Please enter Paypal Email");
		document.getElementById('txtPaypal').focus();
		return false;
	}
		if (document.getElementById('txturl').value =="")
	{
		alert("Please enter Paypal Return URL");
		document.getElementById('txturl').focus();
		return false;
	}
	return true;
}
</script>
<?
include("_footer-admin.php")
?>
