<?php
session_start();
$emailerrr1 = "";
$sladk1 = "";
$emailerrr2 = "";
$sladk2 = "";
//error_reporting(E_ALL);
//header("Cache-control: private");
if (!empty($_POST['Submit'])) {
	$allempty = false;
	foreach ($_POST as $p) {
		if (empty($p)) $allempty = true;
	}
	if (!$allempty) {

		include_once "../dbase.php";
		include_once "../settings.php";

		$errorMsg = "";
		$username = $_POST['UserName'];
		// if (!get_magic_quotes_gpc()) {
		// 	$username = addslashes($username);
		// }



		$result = mysqli_query($conn, "SELECT user FROM chatusers WHERE user='$username'");
		$rowscnd = mysqli_num_rows($result);
		if ($rowscnd > 0) {
			$errorMsg .= "<p>Username exists, please choose another one!</p>";
			$emailerrr1 = "errer";
			$sladk1 = 'eror-msg';
		}

		$result = mysqli_query($conn, "SELECT email FROM chatusers WHERE email='$_POST[Email]'");
		$rowscnd = mysqli_num_rows($result);
		if ($rowscnd > 0) {
			$errorMsg .= "<p>Email exists, please choose another one!</p>";
			$emailerrr2 = "errer";
			$sladk2 = 'eror-msg';
		}

		$result = mysqli_query($conn, "SELECT user FROM chatmodels WHERE user='$username'");
		$rowscnd = mysqli_num_rows($result);
		if ($rowscnd > 0) {
			$errorMsg .= "<p>Username exists, please choose another one!</p>";
			$emailerrr1 = "errer";
			$sladk1 = 'eror-msg';
		}

		$result = mysqli_query($conn, "SELECT email FROM chatmodels WHERE email='$_POST[Email]'");
		$rowscnd = mysqli_num_rows($result);
		if ($rowscnd > 0) {
			$errorMsg .= "<p>Email exists, please choose another one! </p>";
			$emailerrr2 = "errer";
			$sladk2 = 'eror-msg';
		}

		if (md5($_POST['Password1']) != md5($_POST['Password2'])) $errorMsg = "<p>Passwords do not match</p>";
		if (strlen($_POST['UserName']) < 6 || strlen($_POST['UserName']) > 14) $errorMsg = "<p>Username must be 6 to 14 characters long and may not contain spaces.</p>";
		if (strlen($_POST['Password1']) < 6 || strlen($_POST['Password1']) > 14) $errorMsg = "<p>Passwords must be 6 to 14 characters long and may not contain spaces.</p>";


		//if (preg_match("/^[a-z0-9]+?\.
		if ($errorMsg == "") {
			$dateRegistered = time();
			$currentTime = date("YmdHis");
			$userId = md5("$currentTime" . $_SERVER['REMOTE_ADDR']);
			$db_pass = md5($_POST['Password1']);

			$_SESSION['UID'] = $userId;
			$_SESSION['email'] = $_POST['Email'];
			$_SESSION['password'] = $_POST['Password1'];
			$_SESSION['emailtype'] = $_POST['emailtype'];

			$subject = "Your account activation at $sitename";

			if ($_POST['emailtype'] == "text") {
				$message = "Thank you for registering at $sitename. \n
			
			In order to activate your newly created account, click on or copy and paste the link below in your browser:
			
			 $siteurl/actm.php?UID=$userId 
			 
			 Once you activate your membership you will receive an email with your login information.\n\n
			
			Thanks!
			The Webmaster
			
			This is an automated response, please do not reply!";
			} else if ($_POST['emailtype'] == "html") {
				$message = "Thank you for registering at $sitename. \n
			 
			In order to activate your newly created account click on or copy and paste the link below in your browser:
			<br><br>
			<a href='$siteurl/actm.php?UID=$userId'>$siteurl/actm.php?UID=$userId</a><br><br>
			Once you activate your membership you will receive an email with your login information.<br><br>
			Thanks! <br>
			The Webmaster <br>
			This is an automated response, please do not reply!<br>";
			}
			$registrationemail = "$registrationemail";
			//$registrationemail = "$registrationemail";
			include_once("../settings.php");
			$header = "From: " . $registrationemail;
			mail($_POST['Email'], $subject, $message, $header);
			$birthDate = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];
			$gender = $_POST['gender'];
			mysqli_query($conn, "INSERT INTO chatusers ( id , user , password , email , name , birthDate, gender, country , state , city, phone, zip , adress , dateRegistered,lastLogIn, emailnotify ,smsnotify,status,emailtype ) VALUES ('$userId','$username', '{$db_pass}', '{$_POST['Email']}', '{$_POST['Name']}', '{$birthDate}', '{$gender}', '{$_POST['Country']}', '{$_POST['State']}','{$_POST['City']}','{$_POST['phone']}', '{$_POST['ZipCode']}', '{$_POST['Adress']}', '$dateRegistered', '$currentTime','0','0','pending','{$_POST['emailtype']}')");
			header("Location: userregistered.php");
		}
	}
}

include("_reg.header.php");

?>
<style type="text/css">
	.body {
		color: #<? echo $regTextColor ?> !important;
	}


	input,
	button,
	select,
	textarea {
		background-color: #<? echo $regInputBackgroundColor ?> !important;
		color: #<? echo $regInputTextColor ?> !important;
		border-color: #<? echo $regInputBorderColor ?> !important;
		outline: none !important;
		border-radius: 2px !important;
		padding: 5px !important;
		border-width: 0.5px !important;
	}


	/* Button Style */


	input[type=submit] {

		background: #fc0;

		background: linear-gradient(180deg, #fc0, #f98706);

		border: 0;

		border-radius: 2px;

		box-shadow: 0 1px 0 rgba(0, 0, 0, .3);

		color: #441f00 !important;

		cursor: pointer;

		display: inline-block;

		font: 700 14px/30px arial, sans-serif;

		height: 30px;

		margin: 0;

		outline: none;

		padding: 0 19px !important;

		text-align: center;

		text-decoration: none;

		text-shadow: 0 1px hsla(0, 0%, 100%, .4);



	}







	input[type=submit]:hover {

		background: #fc0;

		background: linear-gradient(180deg, #ffd429, #f98706);

		border: 0;

		border-radius: 2px;

		box-shadow: 0 1px 0 rgba(0, 0, 0, .3);

		color: #441f00 !important;

		cursor: pointer;

		display: inline-block;

		font: 700 14px/30px arial, sans-serif;

		height: 30px;

		margin: 0;

		outline: none;

		padding: 0 19px !important;

		text-align: center;

		text-decoration: none;

		text-shadow: 0 1px hsla(0, 0%, 100%, .4);



	}



	.dgdkj {
		background-color: #<? echo $regTableBackgroundColor ?> !important;


	}













	form.modal_register_form .dfngbodjb input#ImageFile,
	form.modal_register_form .dfngbodjb input#ActImage,
	form.modal_register_form .dfngbodjb input#RImage {

		border: 0.5px solid #<? echo $regInputBorderColor ?> !important;
		border-radius: 6px !important;
	}




	.member_sec_top {
		background-color: #<? echo $regTopBarColor ?> !important;
		/* box-shadow: 1px 0 3px #999; */


	}



	#Layer1 {
		visibility: hidden;
		display: none;
	}

	.col-md-10.buton_secc_bregister input {
		background-color: #333;
		color: #fff;
		width: auto;
		/* padding: 6px 15px; */
		/*  height: auto; */
	}

	.col-md-10.buton_secc_bregister input:hover {
		background-color: #333;
		color: #fff;
		width: auto;
		/* padding: 6px 15px; */
		height: auto;
	}






	.footer_input_reg_birthdate select {
		width: 13% !important;
	}

	span.error p {
		color: #ff0000;
		font-size: 15px;
	}

	.member_sec_top {
		padding: 10px 0 !important;
	}

	.eror-msg {
		border: 1px solid #ff0000 !important;
	}
</style>
<script>
	function showStates() {
		var input_data1 = $('#Country').val();
		if (input_data1 == 236) {
			$("#State_id").css("display", "block");
			$("#State").css("display", "none");
		} else {
			$("#State_id").css("display", "none");
			$("#State").css("display", "block");
		}
	}
</script>
<form method="post" name="form1" class='registration-froms formmmmm'>
	<div id="Layer1">
		<tr>
			<td colspan="3" class="form_definitions">
				<div align="center">
					<?php
					if ($_POST['checkbox'] != "checkbox") {
						echo "<font color=#ffdd54>You must agree with the terms:</font><br>";
					}
					?>
					<input name="checkbox" type="checkbox" value="checkbox" checked="checked" <? if (isset($_POST['checkbox']) && $_POST['checkbox'] == "checkbox") {
																									echo "checked";
																								} ?>>

					I Agree with the <a href="memberterms.php" target="_blank" class="left">Terms of Service</a><br>
					Send registration emails as::
					<input name="emailtype" type="radio" value="text" checked>
					Plain text <input name="emailtype" type="radio" value="html"> Html
				</div>
			</td>
		</tr>
	</div>
	<div class="member_sec_top">
		<div class="col-md-12">
			<div class="col-md-6 col-md-6 col-sm-6 col-xs-6">
				<div class="register-left-seciton">Member Registration</div>
			</div>

			<div class="col-md-6 col-md-6 col-sm-6 col-xs-6">
				<div class="register-right-seciton">No Credit Card Required!</div>
			</div>
		</div>

	</div>

	<div class="col-md-12 dgdkj">
		<div class="col-md-12 fdghdh">
			<div class="col-md-12">
				<h3 align="left">
					<span class="small_title">
						<span class="error">
							<?php if (isset($errorMsg) && $errorMsg != "") {
								echo $errorMsg;
							} ?>
						</span>
					</span>
				</h3>
			</div>
			<div class="col-md-12 dfngbodjb">
				<div class="register-title">Login information: </div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['UserName']) && $_POST['UserName'] == "") {
						echo "<p class='errer'>Username*</p>";
						$sladk = 'eror-msg';
					} else if (isset($_POST['UserName']) && (strlen(trim($_POST['UserName'])) < 6 || strlen(trim($_POST['UserName'])) > 8)) {
						echo "<p class='errer'>Username*</p>";
						$sladk = 'eror-msg';
					} else {
						echo "<p class='" . $emailerrr1 . "'>Username*</p>";
					}
					?>
				</div>
				<div class="col-md-10">
					<input name="UserName" value="<?php if (isset($_POST['UserName'])) {
														echo $_POST['UserName'];
													}  ?>" type="text" id="UserName" size="24" maxlength="14" class="<?php echo $sladk1; ?>">
					<p><span class="form_informations style1">Username must be 6 to 14 characters long and may not contain spaces.</span></p>
				</div>

				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Password1']) && $_POST['Password1'] == "")
						echo "<p class='errer'>Password*</p>";
					else if (isset($_POST['Password1']) && (strlen(trim($_POST['Password1'])) < 6 || strlen(trim($_POST['Password1'])) > 14))
						echo "<p class='errer'>Password*</p>";
					else
						echo "<p>Password*</p>";
					?>
				</div>
				<div class="col-md-10">
					<input name="Password1" type="password" id="Password1" size="24" maxlength="14">
					<p><span class="form_informations style1">Password must be 6 to 14 characters long and may not contain spaces.</span></p>
				</div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Password2']) && $_POST['Password2'] == "") {
						echo "<p class='errer'>Re-type Password*</p>";
					} else {
						echo "<p>Re-type Password*</p>";
					}
					?>
				</div>
				<div class="col-md-10 registeration_input_sec">
					<input name="Password2" type="password" id="Password2" size="24" maxlength="14">
				</div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Email']) && $_POST['Email'] == "") {
						echo "<p class='errer'>E-mail*</p>";
						$sladk = 'eror-msg';
					} else {
						echo "<p class='" . $emailerrr2 . "'>E-mail*</p>";
					}
					?>
				</div>
				<div class="col-md-10 registeration_input_sec">
					<input name="Email" value="<?php if (isset($_POST['Email'])) {
													echo $_POST['Email'];
												}  ?>" type="text" id="Email" size="24" maxlength="50" class="<?php echo $sladk2; ?>">
				</div>
			</div>
			<div class="col-md-12 Information_bottom">
				<div class="register-title">Personal Information (Only we see this) </div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Name']) && $_POST['Name'] == "") {
						echo "<p class='errer'>Full Name*</p>";
					} else {
						echo "<p>Full Name*</p>";
					}

					?>
				</div>

				<div class="col-md-10 footer_input_reg">
					<input name="Name" value="<?php if (isset($_POST['Name'])) {
													echo $_POST['Name'];
												}  ?>" type="text" id="Name" size="24" maxlength="24">
				</div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['day']) && $_POST['day'] == "") {
						echo "<p class='errer'>Date of Birth*</p>";
					} else {
						echo "<p>Date of Birth*</p>";
					}
					?>
				</div>
				<div class="col-md-10 footer_input_reg footer_input_reg_birthdate">
					<select name="day" id="day">
						<?php
						for ($i = 1; $i <= 31; $i++) {
							if ($i < 9) {
								$a = $i;
								$i = '0' . $i;
							}
							echo "<option value='$i'";
							if (1 == $i) {
								echo "selected";
							}
							echo ">$i</option>";
							if ($i < 9) {
								$i = $a;
							}
						}
						?>
					</select>
					<select name="month" id="month">
						<option value="Jan" <? if ($_POST['month'] == "January") {
												echo "selected";
											} else if (!isset($_POST['month'])) {
												echo "selected";
											} ?>>January</option>
						<option value="Feb" <? if ($_POST['month'] == "February") {
												echo "selected";
											} ?>>February</option>
						<option value="Mar" <? if ($_POST['month'] == "March") {
												echo "selected";
											} ?>>March</option>
						<option value="Apr" <? if ($_POST['month'] == "April") {
												echo "selected";
											} ?>>April</option>
						<option value="May" <? if ($_POST['month'] == "May") {
												echo "selected";
											} ?>>May</option>
						<option value="Jun" <? if ($_POST['month'] == "June") {
												echo "selected";
											} ?>>June</option>
						<option value="Jul" <? if ($_POST['month'] == "July") {
												echo "selected";
											} ?>>July</option>
						<option value="Aug" <? if ($_POST['month'] == "August") {
												echo "selected";
											} ?>>August</option>
						<option value="Sep" <? if ($_POST['month'] == "September") {
												echo "selected";
											} ?>>September</option>
						<option value="Oct" <? if ($_POST['month'] == "October") {
												echo "selected";
											} ?>>October</option>
						<option value="Nov" <? if ($_POST['month'] == "November") {
												echo "selected";
											} ?>>November</option>
						<option value="Dec" <? if ($_POST['month'] == "December") {
												echo "selected";
											} ?>>December</option>
					</select>
					<select name="year" id="year">
						<?php
						for ($i = 1950; $i <= date('Y') - 18; $i++) {
							echo "<option value='$i'";
							if (date('Y') == $i) {
								echo "selected";
							}
							echo ">$i</option>";
						}
						?>
					</select>
				</div>
				<div class="col-md-2 register_content">
					<p>Gender*</p>
				</div>
				<div class="col-md-10 footer_input_reg">
					<select name="gender" id="gender">
						<option value='Male' selected='selected'>Male</option>
						<option value='Female'>Female</option>
						<option value='TMTOF'>Trans Male To Female</option>
						<option value='TFTOM'>Trans Female To Male</option>
					</select>
				</div>
				<div class="col-md-2 register_content">
					<p>Country</p>
				</div>

				<div class="col-md-10 footer_input_reg">
					<select name="Country" id="Country" onchange="showStates()">
						<?php
						include("../dbase.php");
						include("../settings.php");
						$result = mysqli_query($conn, 'SELECT * FROM countries ORDER BY id');
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='$row[id]'";
							if (isset($_POST['Country']) && $_POST['Country'] == $row['id']) {
								echo "selected";
							}
							echo ">$row[name]</option>";
						}
						mysqli_free_result($result);
						?>
					</select>
				</div>

				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['State']) && $_POST['State'] == "") {
						echo "<p class='errer'>State*</p>";
					} else {
						echo "<p>State*</p>";
					}

					?>

				</div>
				<div class="col-md-10 footer_input_reg">
					<input name="State" value="<?php if (isset($_POST['State'])) {
													echo $_POST['State'];
												} ?>" type="text" id="State" size="24" maxlength="24">
					<select name="State" id="State_id" style="display:none;">
						<?php
						include("../dbase.php");
						include("../settings.php");
						$result = mysqli_query($conn, 'SELECT * FROM states ORDER BY id');
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value='$row[states]'";
							if (isset($_POST['states']) && $_POST['states'] == $row['states']) {
								echo "selected";
							}
							echo ">$row[states]</option>";
						}
						mysqli_free_result($result);
						?>
					</select>
					<!--input name="State" value="<?php if (isset($_POST['State'])) {
														echo $_POST['State'];
													} ?>" type="text" id="State" size="24" maxlength="24"-->
				</div>

				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['City']) && $_POST['City'] == "") {
						echo "<p class='errer'>City*</p>";
					} else {
						echo "<p>City*</p>";
					}
					?>
				</div>
				<div class="col-md-10 footer_input_reg">
					<input name="City" value="<?php if (isset($_POST['City'])) {
													echo $_POST['City'];
												} ?>" type="text" id="City" size="24" maxlength="24">
				</div>

				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['ZipCode']) && $_POST['ZipCode'] == "") {
						echo "<p class='errer'>Zip Code*</p>";
					} else {
						echo "<p>Zip Code*</p>";
					}

					?>
				</div>
				<div class="col-md-10 footer_input_reg">
					<input name="ZipCode" value="<?php if (isset($_POST['ZipCode'])) {
														echo $_POST['ZipCode'];
													}  ?>" type="text" id="ZipCode" size="24" maxlength="24">
				</div>

				<div class="col-md-2 register_content">

				</div>
				<div class="col-md-10 buton_secc_bregister">
					<input type="submit" name="Submit" value="I am at least 18 years of age" />

				</div>
			</div>

		</div>
	</div>
</form>

<?php include("_reg.footer.php"); ?>