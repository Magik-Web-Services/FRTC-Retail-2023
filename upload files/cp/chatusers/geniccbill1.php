<? session_start();
ob_start();
include('../../dbase.php');
?><html>
	<head></head>
	<body onLoad="javascript:submitform();">
	<br/><br/><br/>
	<center>
	<h1>LOADING.......</h1>
	</center>
	
	<? //session_start();
//
// $_SESSION['test']="Ravi Raghav";.
$amt=$_REQUEST['amount'];
if (strstr($_REQUEST['amount'],"."))
{
$amount=floatval($_REQUEST['amount']);
}
else 
{
$amount=$_REQUEST['amount'].".00";	
}


if (strstr($amt,"."))
{
$_SESSION['amt']=$amt;
}
else 
{
$_SESSION['amt']=$amt.".00";	
}
//echo $_SESSION['amt'].'<br/>';
//echo $amount."30840nXKheJN+THbTVTCO4BHJSb8a";
//$formDigest = md5($amount."30840nXKheJN+THbTVTCO4BHJSb8a");

    $sql2="select * from payccbill where code='1'";
    $res2=mysql_query($sql2);
    $row2=mysql_fetch_array($res2);
    
 $sql="select email,url from paymentgate where code='1'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
$amount=9.25;
$formDigest = md5($amount.'10840'.$row2['codtxt']);

//formPrice formPeriod currencyCode salt
//formPrice formPeriod formRecurringPrice formRecurringPeriod formRebills currencyCode salt
?>
<form  name="frmPayment" action='https://bill.ccbill.com/jpost/signup.cgi'  method=POST >
<input type="hidden" name="clientAccnum"  value="<?=$row2['act']?>">
<input type="hidden" name="clientSubacc"  value="<?=$row2['subact']?>">
<input type="hidden" name="formName"  value="<?=$row2['frmname']?>">
<input type="hidden" name="formPrice"  value='<?=$amount?>'>
<input type="hidden" name="formPeriod"  value='10'>
<input type="hidden" name="currencyCode"  value='840'>
<input type="hidden" name="formDigest"  value="<?=$formDigest?>">
</form>

<!-- 
 -->
<?php
//exit;

?>
<!--<input type=submit name=submit  value='Join  Now'>-->

</form>
	<SCRIPT language="JavaScript">
	window.setTimeout(submitform,5000);
	function submitform()
	{
	
document.frmPayment.submit();
	}
</SCRIPT> 
	</body></html>