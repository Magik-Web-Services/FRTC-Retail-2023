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






<table width="1010" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#ffffff">
  <tr>
  
    <td bgcolor="#ffffff" class="form_definitions">
	  <p>&nbsp;</p>
      <p>&nbsp;</p>
      <h1 align="center">Broadcaster Payouts </h1>
      <p align="center">&nbsp;</p>
      <table width="1010" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center"><a href="payments.php">Make Payments</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="paymentop.php">View Payouts </a></div></td>
        </tr>
      </table>
	  <br>
	  <?
	
	//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
	//$secondsAll=time();
		
	include('../dbase.php');
	$count=0;
	$result = mysql_query("SELECT * FROM chatmodels WHERE status!='pending' AND status!='rejected'");
	while($row = mysql_fetch_array($result)) 
	{
	$count++;
	$model=$row[user];
	$minimum=$row[minimum];
	$ammount=0;
	$epercentage=0;
	$tempMinutesPv=0;
	$tempMoneyEarned=0;
	$tempMoneySent=0;
			$month=date("n");
			$year=date("Y");
			$endDate=mktime (0,0,0,22,$month,$year);	
			$result3 = mysql_query("SELECT * FROM videosessions WHERE model='$model' AND paid='0'");
			while($row3 = mysql_fetch_array($result3)) 
				{
				//$ammount= $row3[ammount];
				$epercentage=$row3[epercentage];
				$duration=$row3[duration];
				$cpm=$row3[cpm];
				if($row3[type]=='show'){$ammount=(($duration/60)*$cpm)*($epercentage/100) ;}else {$ammount=$cpm*($epercentage/100) ;}
				$tempMoneyEarned+=$ammount;  			
				}
				
			$total=$tempMoneyEarned;
			if ($total>$minimum){
			$result2 = mysql_query("SELECT id,email, user, pInfo, country, pMethod, name FROM chatmodels WHERE user='$model'");
			while($row2 = mysql_fetch_array($result2)) 
				{	
				echo'<table class="form_definitions" width="700" bgcolor="#ffffff" border="0" align="center" cellpadding="2" cellspacing="1" style="box-shadow: 0px 5px 5px #e6e6e6;border:solid;border-width:0.5px;border-color:#e6e6e6;margin-bottom:5px;border-radius:4px;">
					<tr>
					<td bgcolor="ffffff" >'.$count.') <a href=modelviewdetails.php?id='.$row2[id].'>'.$row2[name].'</a> ( '.$row2[email].' )</td>
					<td bgcolor="ffffff"><b>Ammount: $'.$total .'</b></td>
					</tr> 
					<tr>
					<td bgcolor="ffffff"><p><b>Method:</b> '.$row2[pMethod].'<br><b>Payout Information: </b>'.$row2[pInfo].'</p></td>
					<td valign="middle" bgcolor="#FFF">
					<form name="form1" method="post" action="markpaymentassent.php">
					<input style="background-color:#6c9600;cursor:pointer;color:#fff;" type="submit" name="Submit" value="Mark As Payout Sent">
					<input name="id" type="hidden" id="id" value="'.$row2[id].'">
					<input name="ammount" type="hidden" id="ammount" value="'.$total.'">
					<input name="method" type="hidden" id="method" value="'.$row2[pMethod].'">
					<input name="info" type="hidden" id="info" value="'.$row2[pInfo].'">			
					<input name="email" type="hidden" id="email" value="'.$row2[email].'">
					<input name="username" type="hidden" id="username" value="'.$row2[user].'">
					</form>
					</td>
					</tr></table><br><br>';	
				}
			}
			
			
	}
	echo "<br><br>";

?>	
<br>
</td>
</tr>
</table>
<?
include("_footer-admin.php")
?>
