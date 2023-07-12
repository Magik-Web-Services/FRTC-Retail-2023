<?
include("_header-admin.php")
?>








<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
  <tr>
    <td bgcolor="#F5F5F5">
  <br>
      <table width="600"  border="0" align="center">
        <tr>
          <td colspan="2" class="big_title"><div align="left">
            <h1 align="center">WAIT!</h1>
            <p align="center">&nbsp;</p>
            <p align="center"><b>Are you sure you want to block the account for:</b></p>
            <p align="center"><span class="a_small_title"><h2 align="center"><b><? echo $_POST['username'];?></b><br>
              </p>
          </h2></span></div></td>
        </tr>
        <tr align="center">
          <td width="300" class="big_title"><a href="doblockaccount.php?id=<? echo $_POST['id'];?>&type=<? echo $_POST['type']; ?>&username=<?echo $_POST['username'];?>">Yes block this account</a> </td>
          <td width="290" class="big_title"><a href="<? if($_POST['type']=="model"){echo"modelviewdetails";} else if ($_POST['type']=="member"){echo"memberviewdetails";} else if ($_POST['type']=="sop"){echo"sopviewdetails";}?>.php?id=<? echo $_POST['id'];?>">Return to account information </a></td>
        </tr>
      </table>
      <p><br>	
    </p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
