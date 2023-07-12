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
	if (isset($_POST['btnSubmit']) != "")
	{
		$sql="Update payccbill set act = '".$_POST['act']."',subact = '".$_POST['subact']."',frmname = '".$_POST['frmname']."',codtxt = '".$_POST['codtxt']."' where code ='1'";
		$res=mysql_query($sql);
	}

    $sql="select * from payccbill where code='1'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
    ?>

<form action="" method="POST" onsubmit="return check();">
<table width="720" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#333333">
  <tr>
    <td bgcolor="#333333" class="form_definitions"><p><br>
		Account Name -<br/> <input type="text" name="act" id="act" value="<?=$row['act']?>" size="60"/>    
    </td></tr>
     <tr>
    <td bgcolor="#333333" class="form_definitions"><p><br>
     Sub-Account Name - <br/><input type="text" name="subact" id="subact" value="<?=$row['subact']?>" size="60"/>
    
    </td></tr>
  <tr>
    <td bgcolor="#333333" class="form_definitions"><p><br>
	Form Name -<br/> <input type="text" name="frmname" id="frmname" value="<?=$row['frmname']?>" size="60"/>
    
    </td></tr>
     <tr>
    <td bgcolor="#333333" class="form_definitions"><p><br>
     Code - <br/><input type="text" name="codtxt" id="codtxt" value="<?=$row['codtxt']?>" size="60"/>
    
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
	if (document.getElementById('act').value =="")
	{
		alert("Please enter account name.");
		document.getElementById('act').focus();
		return false;
	}
		if (document.getElementById('subact').value =="")
	{
		alert("Please enter sub-account name.");
		document.getElementById('subact').focus();
		return false;
	}
		if (document.getElementById('frmname').value =="")
	{
		alert("Please enter form name.");
		document.getElementById('frmname').focus();
		return false;
	}
		if (document.getElementById('codtxt').value =="")
	{
		alert("Please enter code.");
		document.getElementById('codtxt').focus();
		return false;
	}
	return true;
}
</script>
<?
include("_footer-admin.php")
?>
