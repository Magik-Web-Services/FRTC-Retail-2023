<?php

if(isset($_POST['accountUser']) && isset($_POST['accountPassword']))

{



include("dbase.php");

include("settings.php");

	if ($_POST['accountType']=="member")

	{

	$database="chatusers";

	} else if ($_POST['accountType']=="model")

	{

	$database="chatmodels";



	} else if ($_POST['accountType']=="studioop")

	{

	$database="chatoperators";

	}

	

	

	$userExists=false;

	$result = mysql_query("SELECT id,user,password,status FROM $database WHERE status!='pending' AND status!='' ");

	while($row = mysql_fetch_array($result)) 

	{

		$tempUser=$row["user"];

		$tempPass=$row["password"];

		$tempId=$row["id"];

		

		if ($_POST['accountUser']==$tempUser && md5($_POST['accountPassword'])==$tempPass)

		{

			if ($row["status"]=="blocked")

			{

			$userExists=true;

			$errorMsg="Account is blocked, please contact the administrator for more details";

			} else {

			

			$userExists=true;

			$currentTime=time();
			
			$randomnumber = rand(1000,9999);
			
			echo $randomnumber;

			die("dfgfdgf");
			
			mysql_query("UPDATE $database SET lastLogIn='$currentTime', loginkey=$randomnumber WHERE id = '$tempId' LIMIT 1");

			setcookie("usertype", $database, time()+3600000);

			setcookie("id", $tempId, time()+3600000);
			
			session_start();
			$_SESSION["loginkey"] = $randomnumber;

			header("Location: cp/$database/");

			}

		}

	

	}

	if (!$userExists){

	$errorMsg="Wrong Username or password, Having trouble logging in? Try reseting your password.";

	}

	

	

} else if (isset($_GET['from']) && $_GET['from']=="recoverpass"){

	$errorMsg="Your new password has been sent to your email address";

} else {

	$errorMsg="";

}


include("_main.header.php");
?>



<head>
<meta http-equiv="refresh" content="4; URL='index.php'" /> 

</head>





<style type="text/css">


.login_sec_cloud {
    margin: 80px auto;
    display: table;
    width: 90%;
	margin-top: 40px;
	margin-bottom: 160px;
    background: #EEE;
	box-shadow: 0px 0px 3px #999;
}



.login {
  border: 1px solid;
  box-shadow: 0px 0px 0px 0px #999;
  display: table;
  margin: 68px auto;
  max-width: 600px;
  padding: 34px;
  width: 100%;
  border-radius: 4px;
}
.login .titulo {
  color: #000;
  font-family: Arial;
  font-size: 14px;
  font-weight: bold;
  height: 16px;
  margin-bottom: 30px;
  padding-bottom: 13px;
  text-align: center;
}
.btntype{
	font-size: 15px;
    padding: 8px;
    background-color: #<? echo $topBarColor1; ?>;
    text-align: center;
    border-radius: 6px;
    margin: 25px;
}
.btntype a{
	color:#fff;
}
.undrtext{
	margin-right: -30px;
    font-size: 15px;
    font-weight: 600;
}
</style>





<?php
include("_main.footer.php");
?>