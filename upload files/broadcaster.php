<?php
if(isset($_POST['accountUser']) && isset($_POST['accountPassword']))

{	
include("dbase.php");
include("settings.php");
$resultdata = mysqli_query($conn, "SELECT a.* FROM user_logged_in as a where a.user='".$_POST['accountUser']."' AND a.logged_in='yes1'");
$rowdata = mysqli_num_rows($resultdata); 
if($rowdata>0){
	$errorMsg = "This user already logged in.";
	
}else{
	mysqli_query($conn, "INSERT INTO user_logged_in SET user='".$_POST['accountUser']."', logged_in='yes'");
	if ($_POST['accountType']=="member")
	{
	$database="chatusers";

	} else if ($_POST['accountType']=="model")

	{

	$database="chatmodels";
	
	$staus_update = ", status='online'";


	} else if ($_POST['accountType']=="studioop")

	{

	$database="chatoperators";

	}

	

	

	$userExists=false;

	$result = mysqli_query($conn, "SELECT id,user,password,status FROM $database WHERE status!='pending' AND status!='' ");

	while($row = mysqli_fetch_array($result)) 

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

			$randomnumber = rand(1000,9999);

		
			
			$userExists=true;

			$currentTime=time();

			mysqli_query($conn, "UPDATE $database SET lastLogIn='$currentTime', loginkey=$randomnumber $staus_update WHERE id = '$tempId' LIMIT 1");

			setcookie("usertype", $database, time()+360000);

			setcookie("id", $tempId, time()+360000);
			
			session_start();
			$_SESSION["loginkey"] = $randomnumber;
			$sql=mysqli_query($conn, "UPDATE chatmodels set forced_logout='no' where id='$tempId'");
			header("Location: cp/$database/");

			}

		}

	

	}

	if (!$userExists){

	$errorMsg="Wrong Username or password";

	}

	

	
}
} else if (isset($_GET['from']) && $_GET['from']=="recoverpass"){

	$errorMsg="Your new password has been sent to your email address";

} else {

	$errorMsg="";

}
include("_main.header.php");
?>


 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
$( document ).ready(function() {
$( "#btn" ).click(function() {
$( "#loginform" ).submit();
});
$(document).keypress(function(e) {
    if(e.which == 13) {
     $( "#loginform" ).submit();
    }
});
});

</script>

   
<style>


/*entire login box */




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
padding: 0 19px;
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
padding: 0 19px;
text-align: center;
text-decoration: none;
text-shadow: 0 1px hsla(0,0%,100%,.4);
width:150px;
}






.login .olvido {
    width: 100%;
    height: auto;
    overflow: hidden;
    padding-top: 25px;
    padding-bottom: 25px;
    font-size: 10px;
    text-align: center;
	
}
.login .olvido .col:first-child {
    width: 45%;
    height: auto;
    float: left;
}
.login .olvido .col {
    width: 52%;
    height: auto;
    float: left;
}
.login .olvido .col:last-child {
    text-align: right !important;
}
.login .olvido .col a {
    color: #<?php echo $loginLinksColor ?> !important;
    text-decoration: none;
    font: 12px Arial;
}
::-webkit-input-placeholder { /* WebKit browsers */
    color:    #<?php echo $loginInputTextColor ?> !important;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:    #<?php echo $loginInputTextColor ?> !important;
    opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:    #<?php echo $loginInputTextColor ?> !important;
    opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    color:    #<?php echo $loginInputTextColor ?> !important;
}
</style>
<div class="login_sec_cloud">
<section class="login">
<p align="center"><b style="color:#<?php echo $errorMessage ?>;"><?php if ( isset($errorMsg) && $errorMsg!=""){ echo $errorMsg; } ?></b></p>

	<div class="titulo">Broadcaster Login</div>
    <form id="loginform" method="post" enctype="application/x-www-form-urlencoded">
      <input type="text" name="accountUser" title="Username required" placeholder="Username" />
      <input type="password" name="accountPassword" title="Password required" placeholder="Password" />
      <input type="hidden" name="accountType" value="model" />
      <div class="olvido">
        <div class="col"><a href="registration/model.php" title="Ver Carásteres">Register</a></div>
        <div class="col"><a href="lostpassword.php" title="Recuperar Password">Forgot Password?</a></div>
      </div>
      <center><a id="btn" class="login-button">Login</a></center>
    </form>
</section>
</div>
<?php
include("_main.footer.php");
?>