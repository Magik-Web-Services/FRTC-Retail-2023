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
  height: 40px;
  z-index: 10;

}

-->

</style>

<?
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		
	include('../dbase.php');
	
	
	$result = mysql_query("SELECT * FROM chatusers WHERE id='$_GET[id]' LIMIT 1");
		while($row = mysql_fetch_array($result)) 
		{
		$tempId=$row["id"];
		$tempUser=$row["user"];
		$tempEmail=$row["email"];
		$tBirthD=$row["birthDate"];
		$tempPhone=$row["phone"];
		$tempName = $row["name"];
		$status=$row['status'];
		$result3=mysql_query("SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
			while($row3 = mysql_fetch_array($result3)) {
			$tempCountry=$row3[name];
			}
		
		$tempState=$row["state"];
		$tempZip = $row["zip"];
		$tempCity=$row["city"];
		$tempAdress = $row["adress"];
		$tempDReg=$row["dateRegistered"];
		$tempMoney=$row[money]/100;
		
		$rowdate=$row["dateRegistered"];
		$date=date("d F Y, H:i",$rawdate);
		}
	?>



<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#F5F5F5">
  <tr>
    <td bgcolor="#F8F8F8">
  <br>
      <table width="641" height="260"  border="0" align="center">
        <tr>
          <td colspan="2" class="big_title"><div align="left">
            <h1 align="center"><b>WAIT!</b></h1>
            <p align="center">&nbsp;</p>
            <p align="center">&nbsp;</p>
            <p align="center"><b>Are you sure you want to delete the account for</b></p>
            <p align="center"><span class="a_small_title"><b><h2 align="center"><? echo $_POST['username'];?><br>
              </p>
          </h2></b></span></div></td>
        </tr>
        <tr align="center">
          <td width="300" align="right" class="big_title"><div align="center"><a href="dodeleteaccount.php?id=<? echo $_POST['id'];?>&type=<? echo $_POST['type']; ?>&username=<?echo $_POST['username'];?>">Yes Delete This Account </a> </div></td>
          <td width="290" class="big_title"><a href="<? if($_POST['type']=="model"){echo"modelviewdetails";} else if ($_POST['type']=="member"){echo"memberviewdetails";} else if ($_POST['type']=="sop"){echo"sopviewdetails";}?>.php?id=<? echo $_POST['id'];?>">Return To Account Information</a> </td>
        </tr>
      </table>
      <p><br>	
    </p></td>
  </tr>
</table>
<?
include("_footer-admin.php")
?>
