<? ob_start();
session_start();
include('../../dbase.php');
if ($_POST['radiobutton'] =="")
{
	?>
	<html>
	<head>
	<style type="text/css">
<!--
.style1 {color: #FFFFFF}
body {
	background-color: #8F0000;
}
-->
    </style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
	<body onLoad="javascript:submitform();">
	<br/><br/><br/>
	<center>
	<h1 class="style1">Loading.......</h1>
	</center>
	
	 <form name="frmPayment" method="post" action="http://www.camgirlselite.com/ccbill/index.htm">
 <input type="hidden" name="cmd" value="_xclick">								
<input type="hidden" name="bn" value="wa_dw_2.0.4">	
<?
    $sql2="select * from payccbill where code='1'";
    $res2=mysql_query($sql2);
    $row2=mysql_fetch_array($res2);
    
 $sql="select email,url from paymentgate where code='1'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
?>						
 <input type="hidden" name="business" value="<?=$row['email']?>"/>			
	<input type="hidden" name="receiver_email" value="<?=$row['email']?>"/>	
		<input type="hidden" name="amount" value="<?=$_REQUEST['amount']?>"/>		
    	<input type="hidden" name="currency_code" value="USD"/>			
	     <input type="hidden" name="return" value="<?=$row['url']?>"/>					
	     <input type="hidden" name="item_name" value="Subscription"/>
		<input type="hidden" name="undefined_quantity" value="0"/>					
    	 <input type="hidden" name="no_shipping" value="1"/>							
		 <input type="hidden" name="no_note" value="1"/>			
		 
	</form>
	<SCRIPT language="JavaScript">
	window.setTimeout(submitform,1000);
	function submitform()
	{
		//if(document.form1.amount.value != ''){
			//alert('Redirecting to ccbill');
		 // 	document.form1.submit();
		// }else{
		 	//alert('Sorry, Invalid Amount.');
			//location.href ="index.php";
		// }
document.frmPayment.submit();
	}
</SCRIPT> 
	</body></html>
	<?
} elseif ($_POST['radiobutton'] =="CCBILL"){?>
<html>
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


$_SESSION['amt']=$amount;
//setcookie("amt",$amount,time()+3600);
//echo $_SESSION['amt'].'<br/>';
//echo $amount."30840nXKheJN+THbTVTCO4BHJSb8a";
//$formDigest = md5($amount."30840nXKheJN+THbTVTCO4BHJSb8a");

    $sql2="select * from payccbill where code='1'";
    $res2=mysql_query($sql2);
    $row2=mysql_fetch_array($res2);
    
 $sql="select email,url from paymentgate where code='1'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
//$amount=9.25;
//$am=$amount;

$formDigest = md5($amount.'30840'.$row2['codtxt']);

//formPrice formPeriod currencyCode salt
//formPrice formPeriod formRecurringPrice formRecurringPeriod formRebills currencyCode salt
?>
<form  name="frmPayment" action='https://bill.ccbill.com/jpost/signup.cgi'  method=POST >
<input type="hidden" name="clientAccnum"  value="<?=$row2['act']?>">
<input type="hidden" name="clientSubacc"  value="<?=$row2['subact']?>">
<input type="hidden" name="formName"  value="<?=$row2['frmname']?>">
<input type="hidden" name="formPrice"  value='<?=$amount?>'>
<input type="hidden" name="formPeriod"  value='30'>
<input type="hidden" name="currencyCode"  value='840'>
<input type="hidden" name="formDigest"  value="<?=$formDigest?>">
<input type="hidden" name="username" value="geniscom"/>
<input type="hidden" name="password" value="genisoft"/>


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

<?}

?>