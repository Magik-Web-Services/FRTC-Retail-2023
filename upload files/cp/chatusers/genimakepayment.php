<?php 
$amount=$_POST['initialPrice']*100;
//if($amount=='')
//$amount=$_POST['accountingAmount'];
//$price=$_POST['initialFormattedPrice'];
$user=$_POST['username'];
$subscription_id=$_POST['subscription_id'];
//$reasonForDecline=$_REQUEST['reasonForDecline'];
$start_date=$_POST['start_date'];
//$reasonForDeclineCode=$_REQUEST['reasonForDeclineCode'];
//if($reasonForDeclineCode)
//if($amount=='')
//$amount=20.95;
//if($user=='')
//$user='geniscom';
//if($subscription_id=='')
//$subscription_id='100000000';
//if($price=='')

//$reasonForDecline='20';
//$start_date='';

include("../../dbase.php");


#Select user and money
$result=mysql_query("SELECT user,money,freetime from chatusers WHERE user='".$user."' LIMIT 1");
$row = mysql_fetch_array($result);
$username=$row['user'];
$money=$row['money'];
$freetime=$row['freetime'];

		//if (strstr($amount,".") == "")
		//$money=$money + $amount.".00";
		//else 
		$money=$money + $amount;	
		
		
	
	
	
	$sql="Update chatusers set money=$money where user='$username'";
	$res=mysql_query($sql);
	
	//date('Y-m-d');
	#echo "insert into payments (ammount, details) values ('".$amount."', '$username')";
	mysql_query("insert into payments (id,ammount,method,details) values ('$subscription_id','$amount','ccbill','$username')");
		
?>