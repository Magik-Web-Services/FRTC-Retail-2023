<?
include ("../dbase.php");
include ("../settings.php");
if ($_GET['type']=="model"){
mysql_query("UPDATE chatmodels SET status='active' WHERE user = '$_GET[username]' LIMIT 1");
} else if($_GET['type']=="member"){
mysql_query("UPDATE chatusers SET status='active' WHERE user = '$_GET[username]' LIMIT 1");
} else if ($_GET['type']=="sop"){
mysql_query("UPDATE chatoperators SET status='active' WHERE user = '$_GET[username]' LIMIT 1");
}

?>
<?
include("_header-admin.php")
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
  <tr>
    <td height="247" bgcolor="#F9F9F9"><p>&nbsp;</p>
      <table width="600"  border="0" align="center">
        <tr>
          <td width="590" class="big_title"><div align="left">
            <h2 align="center"> Account activated</h2>
            <p align="center"><a href="<? if($_GET['type']=="model"){echo"modelviewdetails";} else if ($_GET['type']=="member"){echo"memberviewdetails";} else if ($_GET['type']=="sop"){echo"sopviewdetails";}?>.php?id=<? echo $_GET['id'];?>">Return to account information </a><br>
              </p>
          </div></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>