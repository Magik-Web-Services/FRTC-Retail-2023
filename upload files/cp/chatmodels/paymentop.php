<?php
if (isset($_POST['resettoken'])){ 
include("../../dbase.php");
$idd=$_COOKIE["id"];
$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");
$row = mysql_fetch_array($result); 
$username=$row['user'];	
mysql_query("DELETE FROM videosessions_copy WHERE model='$username'");
mysql_query("UPDATE chatmodels SET tipgoal='0' WHERE user = '$username'");	
$msg = "<b style='color: green; margin-top: 20px; float: left; margin-bottom: 10px;'>Token Goal reset successfully.</b>";
}
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatmodels" )
{
header("location: ../../login.php");
} else{
include("../../dbase.php");
$result=mysql_query("SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
	{	
		$username=$row['user'];	
	}
}

mysql_free_result($result);
$welcomeQuery = "SELECT models FROM welcome"; 
$resultModel = mysql_query($welcomeQuery) or die(mysql_error()); 
$chkN = mysql_num_rows($resultModel) ; 
if($chkN > 0 ) 
{
	$valueWM = mysql_result($resultModel,0,'models'); 
}
else
{
	$valueWM = "Welcome text not defined"; 
}
$msgError="";
include("../../dbase.php");
$id=$_COOKIE["id"];
$model=$username;
if (isset($_POST['paymentSum'])){
	$cpm=$_POST['cpm'];
	$scpm=$_POST['scpm'];
	$tipgoal=$_POST['tipgoal'];
	mysql_query("UPDATE chatmodels SET minimum='$_POST[paymentSum]',cpm='$cpm',scpm='$scpm',tipgoal='$tipgoal' WHERE id = '$id' LIMIT 1");	
	$msgError="<div style='color:#83AE00;'>Change Successful</div>";
}

include("_models.header.php");

$tempMinutesPv=0;
$tempSecondsPv=0;
$tempMoneyEarned=0;
$tempMoneySent=0;
$ammount=0;
$result = mysql_query("SELECT * FROM videosessions WHERE model='$model'");
while($row = mysql_fetch_array($result)) 
{
	$member=$row['member'];
	$epercentage=$row['epercentage'];
	$duration=$row['duration'];
	$cpm=$row['cpm'];
	$tempSecondsPv+=$row['duration'];
	if($row['type']=='show')
	{
	$ammount=round((($duration/60)*$cpm)*($epercentage/100),2) ;
	}
	else
	{
	$ammount=round($cpm*($epercentage/100),2) ;
	}
	$tempMoneyEarned+=$ammount;
	if ($row['paid']=="1"){ $tempMoneySent+=$ammount;}
}
mysql_free_result($result);
$result = mysql_query("SELECT minimum,epercentage,cpm,scpm,tipgoal FROM chatmodels WHERE id='".$id."' LIMIT 1");
while($row = mysql_fetch_array($result)) 
{ 
	$tempMinimum=$row["minimum"];
	$tempCPM=$row['cpm'];
	$tempSCPM=$row['scpm'];
	$tempEPercentage=$row['epercentage'];
	$tipgoal=$row['tipgoal'];
}
mysql_free_result($result);
?>
<style>
input.resettoken {
    border: 0px;
    margin-bottom: 10px;
    background-color: #333333;
    color: #fff;
    padding: 5px 9px;
}
</style>
<div class="main-container-cllss">
	<div class="col-md-12">
		<div class="col-md-5-off">
			<ul class="topmenu">
				<li class="topmenu"><a href="paymentop.php" style="height:10px;line-height:10px;">View Payments</a></li>
				<li class="topmenu"><a href="showslist.php" style="height:10px;line-height:10px;">View Show History</a></li>
			</ul>
			<?php if($msg!=""){
				echo $msg;
			}
			?>
			<div class="error--messagess">
				<div class="error">
					<strong>
					<?php
						if (isset($msgError) && $msgError!="")
						{
							echo $msgError;
						}
					?>
					</strong>
				</div>
				<div class="form_definitions">
					<strong>You are currently receiving <?php echo $tempEPercentage;?>% of your earnings.<br>
					You are currently charging  <?php echo $tempCPM;?> Tokens
					per minute.</strong>
				</div>
				<div class="earnings-mmssgg">
					Your earnings: $<?php echo $tempMoneyEarned; ?><br>
					Payouts so far: $<?php echo $tempMoneySent; ?><br>
					<b> Current account balance: $<?php echo ($tempMoneyEarned-$tempMoneySent) ;?></b>
				</div>
				<div class="earnings-form-seciton">
					<form name="form1" method="post" action="paymentop.php">
						<div class="field-sec-ar">
							<div class="col-md-1 no-padding">$</div>
							<div class="col-md-11 no-padding">
								<select name="paymentSum" id="paymentSum">
								<option value="100"  <?php if ($tempMinimum=="100"){echo "selected";}?>>100</option>
								<option value="250"  <?php if ($tempMinimum=="250"){echo "selected";}?>>250</option>
								<option value="500"  <?php if ($tempMinimum=="500"){echo "selected";}?>>500</option>
								<option value="1000"  <?php if ($tempMinimum=="1000"){echo "selected";}?>>1000</option>
								<option value="2500"  <?php if ($tempMinimum=="2500"){echo "selected";}?>>2500</option>
								<option value="5000"  <?php if ($tempMinimum=="5000"){echo "selected";}?>>5000</option>
								</select> 
								Minimum Payout Goal.							
							</div>
						</div>
						<div class="field-sec-ar">
							<div class="col-md-1 no-padding"></div>
							<div class="col-md-11 no-padding">
							<input size="5" name="cpm" value="<?=($tempCPM);?>"> 
							Tokens Per Minute.
							</div>
						</div>
						<div class="field-sec-ar">
							<div class="col-md-1 no-padding"></div>
							<div class="col-md-11 no-padding">
							<input size="5" name="scpm" value="<?=($tempSCPM);?>"> 
							Spectator Tokens Per Minute.
							</div>
						</div>
						<script>
							$(document).ready(function() {
								$("#tipgoal").keydown(function (e) {
									// Allow: backspace, delete, tab, escape, enter and .
									if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
										 // Allow: Ctrl+A, Command+A
										(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
										 // Allow: home, end, left, right, down, up
										(e.keyCode >= 35 && e.keyCode <= 40)) {
											 // let it happen, don't do anything
											 return;
									}
									// Ensure that it is a number and stop the keypress
									if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
										e.preventDefault();
									}
								});
							});
							</script>
						<div class="field-sec-ar">
							<div class="col-md-1 no-padding"></div>
							<div class="col-md-11 no-padding">
							<input size="5" name="tipgoal" value="<?php echo $tipgoal; ?>" id="tipgoal" class="tipgoal"> 
							Set Token goal.
							</div>
						</div>
						
						<div class="field-sec-ar">
							<input name="image" type="image" src="../../images/newupdate.png" alt="" width="99" height="52" border="0" />
						</div>            
					</form>
					
					<form name="form1" method="post" action="paymentop.php">
					<input type="submit" name="resettoken" class="resettoken" value="Reset Token Goal">
					</form>
				</div>
				<div class="Previous-Payouts-text">
					<strong>Previous Payouts</strong>
					<?php
					include('../../dbase.php');
					$count=0;
					$result = mysql_query("SELECT * FROM payments WHERE id='$id' ORDER BY date DESC");
					while($row = mysql_fetch_array($result)) 
					{
						$count++;	
						$ammount= $row['ammount'];
						echo'<table class="form_definitions" width="1223" bgcolor="#" border="0" align="center" cellpadding="2" cellspacing="1">

						<tr>

						<td class="barbg">'.$count.') <b>Amount: $'.$ammount .'</b> sent on '.date("d M Y, G:i", $row['date']).'</td>

						</tr> 

						<tr>

						<td class="tablebg"><p><b>Payout Method:</b> '.$row['method'].'<br><b>Payout Information: </b>'.$row['details'].'</p></td>

						</tr>

						</table>

						<br>';
					}
					mysql_free_result($result);
					?>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="payment-right-secctt" style="float:left">
				<div style="font-size:20px!important;">Site information & latest news.</div>
				
				<div style="font-size:18px!important;">
					<?php 
					echo $valueWM; 
					?>	 
				</div>

			</div>
		</div>
	</div>
</div>

 <?php  /*   
      <td height="113" class="form_definitions">      
      
	    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
		
        <ul id="css3menu1" class="topmenu">
	 <li class="topmenu"><a href="paymentop.php" style="height:10px;line-height:10px;">View Payments</a></li>
	<li class="topmenu"><a href="showslist.php" style="height:10px;line-height:10px;">View Show History</a></li>
	 

      </tr>

    </table>

      <br>

      <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0">

        <tr>

          <td colspan="2" align="left" valign="top">
		  
		  <p class="error"><strong>

            <?

			if (isset($msgError) && $msgError!="")

			{

			echo $msgError;

			}

			?>

            </p>

            <p class="form_definitions">

            <strong>You are currently receiving <?php echo $tempEPercentage;?>% of your earnings.<br>

            You are currently charging  <?php echo $tempCPM;?> Tokens

  per minute.</strong></p>
            <p class="form_definitions"><strong><br />
            </strong></p></td>
        </tr>

        <tr>

          <td width="50%" height="120" align="left" valign="top">Your earnings: $<?php echo $tempMoneyEarned; ?><br>

Payouts so far: $<?php echo $tempMoneySent; ?><br>

<b> Current account balance: $<?php echo ($tempMoneyEarned-$tempMoneySent) ;?></b></td>

          <td width="50%" height="120" align="left" valign="bottom">          
		  </td>
        </tr>

        <tr>

          <td colspan="2" align="left" valign="top">
		  <form name="form1" method="post" action="paymentop.php">

            <p align="left">$ <select name="paymentSum" id="paymentSum">
                <option value="100"  <?php if ($tempMinimum=="100"){echo "selected";}?>>100</option>
                <option value="250"  <?php if ($tempMinimum=="250"){echo "selected";}?>>250</option>
                <option value="500"  <?php if ($tempMinimum=="500"){echo "selected";}?>>500</option>
                <option value="1000"  <?php if ($tempMinimum=="1000"){echo "selected";}?>>1000</option>
                <option value="2500"  <?php if ($tempMinimum=="2500"){echo "selected";}?>>2500</option>
                <option value="5000"  <?php if ($tempMinimum=="5000"){echo "selected";}?>>5000</option>
              </select> 
              &nbsp;Minimum Payout Goal.</p>
<p align="left">
   &nbsp;&nbsp;
   <input size="5" name="cpm" value="<?=($tempCPM);?>"> 
  &nbsp;Tokens Per Minute.</p>
  <p align="left">
   &nbsp;&nbsp;
   <input size="5" name="scpm" value="<?=($tempSCPM);?>"> 
  &nbsp;Spectator Tokens Per Minute.</p>
            <p align="left">
              &nbsp;&nbsp;<input name="image" type="image" src="../../images/update-btn.png" alt="" width="99" height="52" border="0" />
            </p>
            
          </form>
		  </td>
        </tr>
      </table>            
      <p><strong>Previous Payouts</strong></p>

      <p>	<?


		

	include('../../dbase.php');

	$count=0;

	$result = mysql_query("SELECT * FROM payments WHERE id='$id' ORDER BY date DESC");

	while($row = mysql_fetch_array($result)) 

	{

	$count++;	

	$ammount= $row['ammount'];

	echo'<table class="form_definitions" width="1223" bgcolor="#8F0000" border="0" align="center" cellpadding="2" cellspacing="1">

		<tr>

		<td class="barbg">'.$count.') <b>Amount: $'.$ammount .'</b> sent on '.date("d M Y, G:i", $row['date']).'</td>

		</tr> 

		<tr>

		<td class="tablebg"><p><b>Payout Method:</b> '.$row['method'].'<br><b>Payout Information: </b>'.$row['details'].'</p></td>

		</tr>

		</table>

		<br>';

	}

	mysql_free_result($result);

	?>

	</p>
</td>

  </tr>

</table>

<div id="Layer1">
<h2>Site information & latest news.</h2>
  <h3>
    <?php 
		 	echo $valueWM; 
		 ?>	 
  </h3>
</div>
*/
?>

<?php
include("_models.footer.php");
?>