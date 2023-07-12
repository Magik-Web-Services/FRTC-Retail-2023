<?
include("../../dbase.php");
$result=mysql_query("SELECT * from favorites WHERE model='$_GET[model]' LIMIT 1");
	while($row = mysql_fetch_array($result)) 
	{
	$member=$row[member];
	$result2=mysql_query("SELECT phone,email,emailnotify,smsnotify from chatusers WHERE user='$member' LIMIT 1");
		while($row2 = mysql_fetch_array($result2)) 
		{
		if ($row2[emailnotify]==1){
		$now = date("H:i:s, d F Y ");
		$subject = "Model is Online"; 
		$message = "HI it's $_GET[model] and I just logged on at: $nown <br>Press here to log in to your account<br>$siteurl/login.php<br>Thanks!<br>$_GET[model] <br>This is an automated response, please do not reply!"; 

		mail($row2[mail], $subject, $message, "From:$contactemail\n 
        X-Mailer: PHP/" . phpversion()); 

		}
		
		if ($row2[smsnotify]==1){
		//send sms to $row[phone]
		
		}
	
		}
	
	}
?>