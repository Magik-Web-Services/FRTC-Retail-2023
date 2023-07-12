<?php
$pass = "";
if(!empty($_POST['accountUser']) != "")

{

	include("dbase.php");

include("settings.php");

	if ($_POST['accountType']=="member")

	{

	$database="chatusers";

	} else if ($_POST['accountType']=="model")

	{

	$database="chatmodels";
	

	} else if ($_POST['accountType']=="studioOp")

	{

	$database="chatoperators";

	}

	

	

	$userExists=false;

	$result = mysqli_query($conn, "SELECT user,email,id FROM $database WHERE status!='pending' && status!='rejected'");

	while($row = mysqli_fetch_array($result))

	{

		$tempUser=$row["user"];

		$tempEmail=$row["email"];

		$tempId=$row["id"];

		

		if ($_POST['accountUser']==$tempUser){

			$userExists=true;

			function makeRandomPassword() { 

        	  $salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"; 

	          srand((double)microtime()*1000000); 

	          $i = 0; 

	          while ($i <= 13) { 

	                $num = rand(999,9999999999) % 33; 

	                $tmp = substr($salt, $num, 1); 

	                $pass = $pass . $tmp; 

	                $i++; 

    	      } 

        	 return $pass; 

    	}

		$random_password = makeRandomPassword(); 

    	$db_password = md5($random_password); 

		if ($_POST['accountType']=="member")
		{
			$sitepageurl =  "$siteurl/login_member.php"; 
			$registrationemail1 = $registrationemail;

		}else if ($_POST['accountType']=="model"){
			$sitepageurl =  "$siteurl/broadcaster.php";
			$registrationemail1 = $registrationemail2;
			
		}else if ($_POST['accountType']=="studioOp"){
			$sitepageurl =  "$siteurl/login.php"; 

		}
		//echo "UPDATE $database SET password='$db_password' WHERE id = '$tempId' LIMIT 1";
		//die;
		mysql_query("UPDATE $database SET password='$db_password' WHERE id = '$tempId' LIMIT 1");
	

$subject = "New password for $siteurl account"; 	   		

$charset = "Content-type: text/plain; charset=iso-8859-1\r\n";

$message = "

Your password has been reset. You may change your password after log in on your profile page. 

     

New Password: $random_password 

	 	

$sitepageurl 



For your security we keep the passwords encrypted. 

That is why we can not recover your lost password.



This is an automated response, please do not reply!"; 

	

@mail($tempEmail, $subject, $message,

"MIME-Version: 1.0\r\n".

$charset.

"From:$registrationemail1\r\n".

"Reply-To:$registrationemail1\r\n".

"X-Mailer:PHP/" . phpversion() );

		

header("Location: passwordsent.php");

exit();

		

		}

	

	}

	$errorMsg="Username does not exists";

	

	

} else

{

	$errorMsg="Please complete the username field";

}



?>



<?php
include("_main.header.php");
?><style type="text/css">

.login_sec_cloud {
    margin: 80px auto;
    display: table;
    width: 90%;
	margin-top: 15px;
	margin-bottom: 70px;
    background: #EEE;
	box-shadow: 0px 0px 3px #999;
}




.login {
  border: 1px solid #<?php echo $loginOutlineColor ?> !important;
  border-radius: 6px;
  display: table;
  margin: 68px auto;
  max-width: 422px;
  padding: 34px;
  width: 100%;
  margin-bottom:10%;
  background-color: #<?php echo $loginBackgroundColor ?> !important;
  
}



#select {
  border: 1px solid #<?php echo $loginOutlineColor ?> !important;
  border-radius: 6px;
  display: table;
  margin: 10px auto;
  max-width: 422px;
  padding: 10px;
  width: 100%;
  margin-bottom:10%;
  background-color: #<?php echo $loginBackgroundColor ?> !important;
  
}







/* Header Login Box Text */
.login .titulo {
  color: #<?php echo $loginHeaderTextColor ?> !important;
  font-family: Arial;
  font-size: 14px;
  font-weight: bold;
  height: 14px;
  margin-bottom: 30px;
  padding-bottom: 13px;
  text-align: center;
}

.login form {
    width: 300px;
    height: auto;
    overflow: hidden;
    margin-left: auto;
    margin-right: auto;
}

.login form input[type="text"], .login form input[type="password"] {
  background: transparent none repeat scroll 0 0;
  border: 1px solid #<?php echo $loginOutlineColor ?> !important;
  border-radius: 0;
  
  font-size: 14px;
  height: 40px;
  margin: 0 0 9px;
  outline: medium none;
  padding: 0 10px;
  width: 100%;
}
.login form input[type="text"] {
  border-radius: 4px;
  background-color:#<?php echo $loginInputBackgroundColor ?> !important;
}
.login form input[type=password] {
  border-radius: 4px;
  background-color:#<?php echo $loginInputBackgroundColor ?> !important;
}





/*
.login form .enviar {

  border: medium none;
  border-radius: 6px;
  color: #fff;
  display: block;
  font-family: Arial;
  font-size: 15px;
  font-weight: bold;
  height: 12px;
  padding: 13px 0 33px;
  text-align: center;
  text-decoration: none;
  text-shadow: 0 -1px #1d7464, 0 1px #7bb8b3;
  width: 295px;
} */



.login-button{
background: #<?php echo $loginButtonColor1 ?> !important;
background: linear-gradient(180deg,#<?php echo $loginButtonColor1 ?>,#<?php echo $loginButtonColor2 ?>) !important;
border: 0;
border-radius: 2px;
box-shadow: 0 1px 0 rgba(0,0,0,.3);
color: #<?php echo $loginButtonTextColor ?> !important;
cursor: pointer;
display: inline-block;
font: 700 14px/34px arial,sans-serif;
height: 34px;
margin: 0;
outline: none;
/* padding: 0 19px; */
text-align: center;
text-decoration: none;
text-shadow: 0 1px hsla(0,0%,100%,.4);
width:150px;
}



.login-button:hover{
background: #<?php echo $loginButtonColor1Hover ?> !important;
background: linear-gradient(180deg,#<?php echo $loginButtonColor1Hover ?>,#<?php echo $loginButtonColor2Hover ?>) !important;
border: 0;
border-radius: 2px;
box-shadow: 0 1px 0 rgba(0,0,0,.3);
color: #<?php echo $loginButtonTextColor ?> !important;
cursor: pointer;
display: inline-block;
font: 700 14px/34px arial,sans-serif;
height: 34px;
margin: 0;
outline: none;
/* padding: 0 19px; */
text-align: center;
text-decoration: none;
text-shadow: 0 1px hsla(0,0%,100%,.4);
width:150px;
}


.login .olvido {
    width: 300px;
    height: auto;
    overflow: hidden;
    padding-top: 10px;
    padding-bottom: 25px;
    font-size: 13px;
    text-align: center;
	color: #<?php echo $loginHeaderTextColor ?> !important;
}

.login .olvido .col {
    width: 50%;
    height: auto;
    float: left;
}

.login .olvido .col a {
    color: #000;
    text-decoration: none;
    font: 12px Arial;
}
::-webkit-input-placeholder { /* WebKit browsers */
    color:    #666666;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:    #666666;
    opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:    #666666;
    opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    color:    #666666;
}

.hoverBtn {
    opacity: 1.0;

	
}


.hoverBtn:hover {
    opacity: 0.8;
}




</style>
<div class="login_sec_cloud-off">
<section class="login">
	<div class="titulo">Password Reset</div>
	<form id="loginform" action="lostpassword.php" method="post" enctype="application/x-www-form-urlencoded" name="form1">
    	<input type="text" name="accountUser" title="Username required" placeholder="Username"required>
        <select name="accountType" id="select"required>

			<option value="member">Select Account Type</option>
			
			<option value="member">Member Account </option>

			<option value="model">Broadcaster Account </option>
		</select>

        <div class="olvido">
        	<div> <p align="center">Your new password will be sent to you via email. </p></div>
            <div align="center">The system will generate a new password for you. After you login again you can change it from the &quot;My Profile&quot; link in your account control panel. </div>
        </div>
        <center><div class="login-button" style="text-align:center"><button class="login-button" type="submit" style="text-align:center">Reset</button></div></center>
    </form>
</section>
</div>

<?php
include("_main.footer.php");
?>