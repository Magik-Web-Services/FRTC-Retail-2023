<?php include("_main.header.php"); ?>
<style type="text/css">
.actm_main_container{
    width: 90% ;
    margin: 0 auto;
    display: table;
}
.actm_sub_main_container {
    background-color: #eeee;
    box-shadow: 1px 1px 3px #999;
    margin: 29px 0px;
    padding: 30px 20px;
    float: left;
    width: 100%;
}
</style>
<div class="actm_main_container">
<div class="actm_sub_main_container">
<?php

$result=mysql_query("SELECT email,user,password,emailtype,status from chatusers WHERE id = '$_GET[UID]' LIMIT 1");
while($row = mysql_fetch_array($result)) 

	{

	$email=$row['email'];

	$user=$row['user'];

	$pass=$row['password'];

	$my_pass=$row['password'];

	$db_pass=md5($pass);

	$status=$row['status'];

	$emailtype=$row['emailtype'];

	}

if ($status!="pending"){

echo '<center><h5>This account is already active</h5></center>';

} else {

	mysql_query("UPDATE chatusers SET password='$db_pass', status='active' WHERE id ='$_GET[UID]' LIMIT 1");	

	if ($emailtype=="text"){

	$charset="Content-type: text/plain; charset=iso-8859-1\r\n";

	$message = "Here are your login details for your member account. You may change your password after log in on your profile page.
	Please keep a record of your login details for future use.
	

username:$user

password:$my_pass



You can login at the following address: 

$siteurl/login_member.php?user=$user


Thanks.
The Webmaster 

This is an automated system email, please do not reply!";



	} else if($emailtype=="html"){



	$charset="Content-type: text/html; charset=iso-8859-1\r\n";

	$message = "Here are your login details for your member account account.
	Please keep a record of your login details for future use.



username:$user

password:$my_pass



You can login at the following address: 



<a href='$siteurl/login_member.php?user=$user'>$siteurl/login_member.php?user=$user</a>


The Webmaster 

This is an automated system email, please do not reply!";



	}else{

	echo"Email variable not set";

	}



$subject = "Your login information at $siteurl"; 



mail($email, $subject, $message,

     "MIME-Version: 1.0\r\n".

     $charset.

     "From:$registrationemail\r\n".

     "Reply-To:$registrationemail\r\n".

     "X-Mailer: PHP/" . phpversion() );



echo '<center><h5>Activation Successful, You may now login to your member account</h5><a href="login_member.php">HERE</a></center>.';

}
?>
</div>
</div>
<?php include("_main.footer.php"); ?>