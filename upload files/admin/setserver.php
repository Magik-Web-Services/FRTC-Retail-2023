<?php
include("_header-admin.php");
?>
	
	<?php
	
	
	include('../dbase.php');
	if (isset($_POST['media'])&& $_POST['media']!= '')
	{ 
		$sql="UPDATE setting  SET value = '".$_POST['media']."' WHERE type = 'media_server' ";
		$res=mysql_query($sql);
	}

    

    $sql="SELECT * FROM setting WHERE type = 'media_server' ";
    if($row=mysql_fetch_array(mysql_query($sql))){

    }else{
        
mysql_query("INSERT INTO setting (type) VALUES ('media_server')");
    }
    ?>

<form action="" method="POST" onsubmit="return check();">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <div align="center">
    <table width="1010" border="0">
      <tr>
        <td><div align="center">          
          <h1>Videochat Media Server Configuration <br />
          </h1>
        </div></td>
      </tr>
    </table>
  </div>
  <table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">
  <tr>
    <td bgcolor="#ffffff" class="form_definitions"><p align="center">Enter the url required to connect with the media server.     
      <p align="center"><br>
        Media server url:<br/>
        <input type="text" name="media" id="msu" value="<?=$row['value']?>" size="60"/>    
        </td></tr>
    <tr>
      <td bgcolor="#ffffff" class="form_definitions"><p align="center"><br>
    <input type="submit" value=" Save " name="btnSubmit"/>
    
    </td>
</tr>
</table>
</form>
<script language="javascript" type="text/javascript">
function check()
{
	if (document.getElementById('msu').value =="")
	{
		alert("Please enter media server url.");
		document.getElementById('msu').focus();
		return false;
	}
	return true;
}
</script>
<?php
include("_footer-admin.php")
?>
