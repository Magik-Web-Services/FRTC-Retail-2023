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
<h1 align="center" class="style1">Performers awaiting approval</h1>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td><div align="center"><br>
        <?
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		
	include('../dbase.php');
	
	

	              echo '<table width="1010" bgcolor="#ffffff" border="0" align="left" cellpadding="0" cellspacing="0">';
		$result2 = mysql_query("SELECT * FROM chatmodels WHERE status='pending'");
		while($row2 = mysql_fetch_array($result2)) 
		{
			$tempCity=$row2[city];
			$result3=mysql_query("SELECT name FROM countries WHERE id='$row2[country]' LIMIT 1");
			while($row3 = mysql_fetch_array($result3)) {
			$sName=$row3[name];
			}
		if ($color=="#ffffff"){
			$color="#ffffff";
			}else{ $color="#ffffff";}
			
		echo'<tr class="form_definitions"><td><b>'.$row2[user].'</b></td><td>'.$sName.'</td><td>$'.$row2[cpm]/100 .'/min</td><td><a href="subscriptionviewdetails.php?id='.$row2[id].'">View Details</a></td></tr>'; 
		}
echo '</table>';
	?>
        	
    </div></td>
  </tr>
</table><br>
<?
include("_footer-admin.php")
?>
