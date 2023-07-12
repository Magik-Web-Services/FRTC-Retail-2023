<?
include('../../dbase.php');
if ($_POST['radiobutton'] =="paypal")
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
	
	 <form name="frmPayment" method="post" action="https://www.paypal.com/cgi-bin/webscr">
 <input type="hidden" name="cmd" value="_xclick">								
<input type="hidden" name="bn" value="wa_dw_2.0.4">	
<?
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
			//alert('Redirecting to paypal');
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
} elseif ($_POST['radiobutton'] =="google"){?>


<?}

?>