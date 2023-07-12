<? ob_start();
session_start();
//var_dump($_SESSION);
mysql_connect("localhost","lakeview","payperview");
mysql_select_db("lakeview") or die("ENDDDDDDddd");

//if ($_REQUEST['initialPrice'] == "")
//{
//	$_REQUEST['initialPrice']="192.168.0.1";
//}

//if ($_POST['ip_address'] !="")
//{
//$ip=$_REQUEST['ip_address'];
//$initial=$_REQUEST['initialPrice'];
//
//$id=$_REQUEST['uid'];
////$id=10;
//
//if ($id =="")
//{
//	$id=$_SESSION['id'];
//}
//$sql="Insert into users_purchases(IP,amount,uid,dateIt) values ('$ip','$initial','$id','".time()."')";
//mysql_query($sql) or die("QUERY ISSUE");
//
//$sql="select balance from users where id='$id'";
//$res=mysql_query($sql);
//$row=mysql_fetch_array($res);
//$amount = $row['balance'];
//$amount = $amount + $initial;
//$sql="Update users set balance='$amount' ,dateIt='".time()."' where id='$id'";
//mysql_query($sql) or die("QUERY ISSUE2");
//$_SESSION['balance']=$amount;
$responseDigest = md5($HTTP_GET_VARS['subscription_id'] . 1 . "nXKheJN+THbTVTCO4BHJSb8a");

			//If Digest Does not match fail transaction (hacking attempt)
			if (strcmp($responseDigest, $HTTP_GET_VARS['responseDigest']) != 0){
				echo "Digest doesn't match";
			}
			else 
			{
				include("dbase.php");


$result=mysql_query("SELECT user,money from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];$money=$row['money'];	}
$money=$money + $_SESSION['amt'];
			 $sql="Update chatusers set money=$money where user='$username'";
			 $res=mysql_query($sql);
	mysql_query("insert into payments (ammount, details) values ('".$_SESSION['amt']."', '$username')");
	echo '<script>window.location="http://www.fmsdesigns.com/fix/cp/chatusers/buyminutes.php"</script>';
			}

//}
//echo '<script>window.location="http://www.flvpayperview.com/lakeview/index.php"</script>';
?>