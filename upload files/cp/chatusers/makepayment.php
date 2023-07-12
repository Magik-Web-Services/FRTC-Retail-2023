<? if (!isset($_COOKIE["id"]) || $_COOKIE['usertype']!="chatusers" )

{

header("location: ../../login.php");

} else{

include("../../dbase.php");

$result=mysql_query("SELECT user from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row[user];	}

}

?>

<?
include("_members.header.php");
?><style type="text/css">
<!--
body,td,th {
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
body {
	background-color: #8F0000;
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: none;
	color: #FFCC00;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
-->
</style>

<table width="720" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#8F0000" class="form_definitions">

  <tr valign="top">

    <td>
    <?
ob_start();

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];
$auth_token = "ZpnErSeMfYzm_hMXS9ldyHtbLlp5t15bww03vmIK-x1k9sfdZ6SyILPuStG";
$req .= "&tx=$tx_token&at=$auth_token";

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
// read the body data
$res = '';
$headerdone = false;
while (!feof($fp)) {
$line = fgets ($fp, 1024);
if (strcmp($line, "\r\n") == 0) {
// read the header
$headerdone = true;
}
else if ($headerdone)
{
// header has been read. now read the contents
$res .= $line;
}
}

// parse the data
$lines = explode("\n", $res);
$keyarray = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
//for ($i=1; $i<count($lines);$i++){
//list($key,$val) = explode("=", $lines[$i]);
//$keyarray[urldecode($key)] = urldecode($val);
//}
//// check the payment_status is Completed
//// check that txn_id has not been previously processed
//// check that receiver_email is your Primary PayPal email
//// check that payment_amount/payment_currency are correct
//// process payment
//$firstname = $keyarray['first_name'];
//$lastname = $keyarray['last_name'];
//$itemname = $keyarray['item_name'];
//$amount = $keyarray['payment_gross'];
//
//echo ("<p><h3>Thank you for your purchase!</h3></p>");
//
//echo ("<b>Payment Details</b><br>\n");
//echo ("<li>Name: $firstname $lastname</li>\n");
//echo ("<li>Item: $itemname</li>\n");
//echo ("<li>Amount: $amount</li>\n");
//echo ("");
//dl_file("full/whyinstrumental.mp3");
include("../../dbase.php");


$result=mysql_query("SELECT user,money from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];$money=$row['money'];	}
	if (strstr($_REQUEST[amt],".") == "")
	{
echo $money=$money + $_REQUEST[amt].".00";
	}
	else 
	{
	$money=$money + $_REQUEST[amt];	
	}
			echo $sql="Update chatusers set money=$money where user='$username'";
			 $res=mysql_query($sql);
	mysql_query("insert into payments (ammount, details) values ('".$_REQUEST['amt']."', '$username')");
	echo '<script>window.location="buyminutes.php"</script>';

}
else if (strcmp ($lines[0], "FAIL") == 0) {
	//var_dump($_REQUEST);
// log for manual investigation
include("../../dbase.php");

$result=mysql_query("SELECT user,money from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while($row = mysql_fetch_array($result)) 

	{	$username=$row['user'];$money=$row['money'];	}
if (strstr($_REQUEST[amt],".") == "")
	{
echo $money=$money + $_REQUEST[amt].".00";
	}
	else 
	{
	$money=$money + $_REQUEST[amt];	
	} 	
			$sql="Update chatusers set money=$money where user='$username'";
			 $res=mysql_query($sql);
	mysql_query("insert into payments (ammount, details) values ('".$_REQUEST['amt']."', '$username')");
	echo '<script>window.location="buyminutes.php"</script>';
}

}

fclose ($fp);


//if ($_REQUEST['st'] == 'Pending' || $_REQUEST['st'] == 'Completed')
//{
//	
//}
//var_dump($_REQUEST);
//

?>
    </td>
  </tr>

      

      <tr>

        <td class="form_definitions"> <p>&nbsp;</p>          </td>

      </tr>

</table>

	<br>



	</td>

  </tr>

</table>

<?
include("_members.footer.php");
?>