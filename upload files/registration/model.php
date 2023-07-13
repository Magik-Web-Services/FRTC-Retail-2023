<?php
session_start();
$errorMsg = "";
$labelerr1 = "";
$labelerr2 = "";
$flderrr1 = "";
$flderrr2 = "";
if (isset($_POST['UserName']) != "" && isset($_POST['Password1']) != "" && isset($_POST['Password2']) != "" && isset($_POST['Email']) != "") {
	include("../dbase.php");
	include("../settings.php");
	$replacevalues = array('&', '/', " ", "?", "+", "%", "$", "#", "@");
	$username = str_replace($replacevalues, "", $_POST['UserName']);

	$result = mysqli_query($conn, "SELECT user FROM chatusers WHERE user='$username'");
	$rowscnd = mysqli_num_rows($result);
	if ($rowscnd > 0) {
		$errorMsg .= "<p>Username exists, please choose another one!</p>";
		$labelerr1 = "errer";
		$flderrr1 = "eror-msg";
	}

	$result = mysqli_query($conn, "SELECT email FROM chatusers WHERE email='$_POST[Email]'");
	$rowscnd = mysqli_num_rows($result);
	if ($rowscnd > 0) {
		$errorMsg .= "<p>Email exists, please choose another one!</p>";
		$labelerr2 = "errer";
		$flderrr2 = "eror-msg";
	}

	$result = mysqli_query($conn, "SELECT user FROM chatmodels WHERE user='$username'");
	$rowscnd = mysqli_num_rows($result);
	if ($rowscnd > 0) {
		$errorMsg .= "<p>Username exists, please choose another one!</p>";
		$labelerr1 = "errer";
		$flderrr1 = "eror-msg";
	}

	$result = mysqli_query($conn, "SELECT email FROM chatmodels WHERE email='$_POST[Email]'");
	$rowscnd = mysqli_num_rows($result);
	if ($rowscnd > 0) {
		$errorMsg .= "<p>Email exists, please choose another one! </p>";
		$labelerr2 = "errer";
		$flderrr2 = "eror-msg";
	}

	if ($_POST['Password1'] != $_POST['Password2']) {
		//if passwords do not match
		$errorMsg .= "<br>Passwords do not match<br>";
	}

	if (strlen($_POST['Password1']) < 6) {
		//if password length is less than 6
		$errorMsg .= "<br>Passwords must be at least 6 characters long<br>";
	}
	@rmdir("../models/" . $username . "/");
	@mkdir("../models/" . $username . "/");
	$dateRegistered = time();
	$currentTime = date("YmdHis");
	$userId = md5("$currentTime" . $_SERVER['REMOTE_ADDR']);
	$urlIdentityImage = "../models/" . $username . "/" . $userId . ".jpg";
	$urlRImage = "../models/" . $username . "/representative.jpg";
	if ($_FILES['ImageFile']['tmp_name'] != "" && isset($_POST['native_language'])) {
		$urlThumbnail = "../models/" . $username . "/thumbnail.jpg";

		if ($check = getimagesize($_FILES['ImageFile']['tmp_name'])) {
			$src = imagecreatefromstring(file_get_contents($_FILES['ImageFile']['tmp_name']));
			$theight = 910;
			$twidth = 620;
			$tmp = imagecreatetruecolor($theight, $twidth);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $theight, $twidth, $check[0], $check[1]);
			imagejpeg($tmp, $urlThumbnail, 100);
		} else {
			$errorMsg = "File not Copied";
		}
	}
	if (!isset($_FILES['ActImage']['tmp_name']) && !copy($_FILES['ActImage']['tmp_name'], $urlIdentityImage)) {
		$errorMsg .= "<br>Could not load ID image to database";
	}
	if (!isset($_FILES['ActImage']['tmp_name']) && !copy($_FILES['RImage']['tmp_name'], $urlRImage)) {

		$errorMsg .= "<br>Could not load representative image to database";
	}


	if ($errorMsg == "") {
		$pass = $_POST['Password1'];
		$db_pass = md5($pass);
		$birthDate = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];
		$_SESSION['dateregistered'] = $dateRegistered;
		$_SESSION['userid'] = $userId;
		$_SESSION['userid3'] = 'nasnas';
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $_POST['Password1'];
		//$_SESSION['L1'] = $_POST['L1'];
		$_SESSION['password_encrypted'] = $db_pass;
		$_SESSION['name'] = $_POST['Name'];
		$_SESSION['email'] = $_POST['Email'];
		$_SESSION['country'] = $_POST['Country'];
		$_SESSION['state'] = $_POST['State'];
		$_SESSION['city'] = $_POST['City'];
		$_SESSION['zipcode'] = $_POST['ZipCode'];
		$_SESSION['adress'] = $_POST['Adress'];
		$_SESSION['phone'] = $_POST['phone'];
		$_SESSION['emailtype'] = $_POST['emailtype'];
		$_SESSION['birthDate'] = $birthDate;
		$_SESSION['gender'] = $_POST['gender'];
		$_SESSION['Category'] = $_POST['Category'];
		// $_SESSION['race_ethnicity'] = implode(", ", $_POST["race_ethnicity"]);
		// $_SESSION['native_language'] = implode(", ", $_POST["native_language"]);
		session_write_close();
		mysqli_query($conn, "insert into chatmodels (id,user,password,email,phone,name,gender,country,state,city,zip,adress,dateRegistered,status,birthDate,native_language,category,race_ethnicity,Spy_Shows)values('$userId','$username','$db_pass','$_SESSION[email]','$_SESSION[phone]','$_SESSION[name]','$_SESSION[gender]','$_SESSION[country]','$_SESSION[state]','$_SESSION[city]','$_SESSION[zipcode]','$_SESSION[adress]','$dateRegistered','pending', '$_SESSION[birthDate]', '$_SESSION[native_language]','$_POST[Category]','$_SESSION[race_ethnicity]','no')");

		$dt = date('m/d/Y H:i:s', $_SESSION['dateregistered']);
		$subject = "New broadcaster registration ('" . $_SESSION['username'] . "')";
		$charset = "Content-type: text/plain; charset=iso-8859-1\r\n";
		$message = "'" . $_SESSION['username'] . "' has just registered at $siteurl
		To view the broadcaster details use the link below:
		$siteurl/admin/subscriptionviewdetails.php?id=" . $_SESSION['userid'] . "
		Date and time registered: $dt ";
		// mail(
		// 	$registrationemail2,
		// 	$subject,
		// 	$message,
		// 	"MIME-Version: 1.0\r\n" .
		// 		$charset .
		// 		"From: $registrationemail2\r\n" .
		// 		"Reply-To: $registrationemail2\r\n" .
		// 		"X-Mailer:PHP/" . phpversion()
		// );
		header("Location: modelregistered.php");
	}
} else {
	$errorMsg = "You must fill in all required fields marked with a *.";
}
include("_reg.header.php");
?>





<style type="text/css">
	.body {
		color: #<?php echo $regTextColor ?> !important;


	}


	input,
	button,
	select,
	textarea {
		background-color: #<?php echo $regInputBackgroundColor ?> !important;
		color: #<?php echo $regInputTextColor ?> !important;
		border-color: #<?php echo $regInputBorderColor ?> !important;
		outline: none !important;
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

		height: 30px !important;

		margin: 0;

		outline: none;

		padding: 0 19px;

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

		height: 30px !important;

		margin: 0;

		outline: none;

		padding: 0 19px;

		text-align: center;

		text-decoration: none;

		text-shadow: 0 1px hsla(0, 0%, 100%, .4);



	}



	.dgdkj {
		background-color: #<?php echo $regTableBackgroundColor ?> !important;


	}













	form.modal_register_form .dfngbodjb input#ImageFile,
	form.modal_register_form .dfngbodjb input#ActImage,
	form.modal_register_form .dfngbodjb input#RImage {

		border: 0.5px solid #<?php echo $regInputBorderColor ?> !important;
		/* border-radius: 6px !important; */
		padding: 5px !important;
	}




	.member_sec_top {
		background-color: #<?php echo $regTopBarColor ?> !important;
		/* box-shadow: 1px 0 3px #999; */
	}



	#Layer1 {
		visibility: hidden;
		display: none;
	}

	span.error p {
		color: #ff0000;
	}

	.eror-msg {
		border: 1px solid #ff0000 !important;
	}

	@media (max-width: 767px) {
		.dfngbodjb .col-md-2.register_content {
			padding: 0;
			display: block;
			clear: both;
		}
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
<form class="modal_register_form" method="post" enctype="multipart/form-data" name="form1" target="_self">
	<div id="Layer1">
		<tr>
			<td colspan="3" class="form_definitions">
				<div align="center">
					<?php
					if ($_POST['checkbox'] != "checkbox") {
						echo "<font color=#ffdd54>You must agree with the terms of service to register:</font><br>";
					}
					?>
					<input name="checkbox" type="checkbox" value="checkbox" checked="checked" <?php if (isset($_POST['checkbox']) && $_POST['checkbox'] == "checkbox") {
																									echo "checked";
																								} ?> />
					I Agree with the <a href="modelterms.php" target="_blank" class="left">Terms of Service </a>.<br />
					<br />Send registration email as: <input name="emailtype" type="radio" value="text" checked="checked" /> Plain text
					<input name="emailtype" type="radio" value="html" />
				</div>
			</td>
		</tr>
	</div>
	<div class="member_sec_top">
		<div class="col-md-12">
			<div class="register-left-seciton">Start making money as a live webcam broadcaster today!</div>
		</div>
	</div>
	<div class="col-md-12 dgdkj">
		<div class="col-md-12 fdghdh">
			<div class="col-md-12 dfngbodjb">
				<div class="register-title">
					<span class="error">
						<?php if (isset($errorMsg) && $errorMsg != "") {
							echo $errorMsg;
						} ?>
					</span>
				</div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['UserName']) && $_POST['UserName'] == "")
						echo "<p class='errer'>Username*</p>";
					else if (isset($_POST['UserName']) && (strlen(trim($_POST['UserName'])) < 6 || strlen(trim($_POST['UserName'])) > 14))
						echo "<p class='errer'>Username*</p>";
					else
						echo "<p class='" . $labelerr1 . "'>Username*</p>";
					?>
				</div>
				<div class="col-md-10">
					<input name="UserName" value="<?php if (isset($_POST['UserName'])) {
														echo $_POST['UserName'];
													}  ?>" type="text" id="UserName" size="24" maxlength="14" class="<?php echo $flderrr1; ?>">
					<p><span class="form_informations style1">Username must be between 6 and 14 characters.</span></p>
				</div>

				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Password1']) && $_POST['Password1'] == "") {
						echo "<p class='errer'>Password*</p>";
					} else {
						echo "<p>Password*</p>";
					}
					?>
				</div>
				<div class="col-md-10">
					<input name="Password1" type="password" id="Password1" size="24" maxlength="14">
					<p><span class="form_informations style1">Password must be between 6 and 14 characters.</span></p>
				</div>
				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Password2']) && $_POST['Password2'] == "") {
						echo "<p class='errer'>Password*</p>";
					} else {
						echo "<p>Password*</p>";
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
					} else {
						echo "<p class='" . $labelerr2 . "'>E-mail*</p>";
					}
					?>
				</div>
				<div class="col-md-10 registeration_input_sec">
					<input name="Email" value="<?php if (isset($_POST['Email'])) {
													echo $_POST['Email'];
												}  ?>" type="text" id="Email" size="24" maxlength="50" class="<?php echo $flderrr2; ?>">
				</div>
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
							echo ">$i
							</option>";
							if ($i < 9) {
								$i = $a;
							}
						}
						?>
					</select>
					<select name="month" id="month">
						<option value="Jan" <?php if (isset($_POST['month']) == "January") {
												echo "selected";
											} else if (!isset($_POST['month'])) {
												echo "selected";
											} ?>>January</option>
						<option value="Feb" <?php if (isset($_POST['month']) == "February") {
												echo "selected";
											} ?>>February</option>
						<option value="Mar" <?php if (isset($_POST['month']) == "March") {
												echo "selected";
											} ?>>March</option>
						<option value="Apr" <?php if (isset($_POST['month']) == "April") {
												echo "selected";
											} ?>>April</option>
						<option value="May" <?php if (isset($_POST['month']) == "May") {
												echo "selected";
											} ?>>May</option>
						<option value="Jun" <?php if (isset($_POST['month']) == "June") {
												echo "selected";
											} ?>>June</option>
						<option value="Jul" <?php if (isset($_POST['month']) == "July") {
												echo "selected";
											} ?>>July</option>
						<option value="Aug" <?php if (isset($_POST['month']) == "August") {
												echo "selected";
											} ?>>August</option>
						<option value="Sep" <?php if (isset($_POST['month']) == "September") {
												echo "selected";
											} ?>>September</option>
						<option value="Oct" <?php if (isset($_POST['month']) == "October") {
												echo "selected";
											} ?>>October</option>
						<option value="Nov" <?php if (isset($_POST['month']) == "November") {
												echo "selected";
											} ?>>November</option>
						<option value="Dec" <?php if (isset($_POST['month']) == "December") {
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
					<p>Country*</p>
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
					<p>Spoken/written Language*</p>
				</div>
				<div class="col-md-10 footer_input_reg">

					<ul class="Race-Ethnicity">
						<li><input name="native_language[]" class="native_language" type="checkbox" value="English" /> English</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Dutch" /> Dutch</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="French" /> French</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Latin" /> Latin</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="German" /> German</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Italian" /> Italian</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Japanese" /> Japanese</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Korean" /> Korean</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Portuguese" /> Portuguese</li>
						<li><input name="native_language[]" class="native_language" type="checkbox" value="Spanish" /> Spanish</li>
					</ul>


					<!--select name="L1" id="L1">
						<option value="English"  <?php if (isset($_POST['L1']) && $_POST['L1'] == "English") {
														echo "selected";
													} else if (!isset($_POST['L1'])) {
														echo "selected";
													} ?>>English</option>

						<option value="Dutch" <?php if (isset($_POST['L1']) && $_POST['L1'] == "Dutch") {
													echo "selected";
												} ?>>Dutch</option>

						<option value="French" <?php if (isset($_POST['L1']) && $_POST['L1'] == "French") {
													echo "selected";
												} ?>>French</option>

						<option value="German" <?php if (isset($_POST['L1']) && $_POST['L1'] == "German") {
													echo "selected";
												} ?>>German</option>

						<option value="Italian" <?php if (isset($_POST['L1']) && $_POST['L1'] == "Italian") {
													echo "selected";
												} ?>>Italian</option>

						<option value="Japanese" <?php if (isset($_POST['L1']) && $_POST['L1'] == "Japanese") {
														echo "selected";
													} ?>>Japanese</option>

						<option value="Korean" <?php if (isset($_POST['L1']) && $_POST['L1'] == "Korean") {
													echo "selected";
												} ?>>Korean</option>

						<option value="Portuguese" <?php if (isset($_POST['L1']) && $_POST['L1'] == "Portuguese") {
														echo "selected";
													} ?>>Portuguese</option>

						<option value="Spanish" <?php if (isset($_POST['L1']) && $_POST['L1'] == "Spanish") {
													echo "selected";
												} ?>>Spanish</option>	       

					</select-->
				</div>
				<div class="col-md-2 register_content">
					<p>Category</p>
				</div>
				<div class="col-md-10 footer_input_reg">
					<select name="Category" id="Category">
						<?php
						$query = mysqli_query($conn, "select * from category order by name asc");
						while ($row = mysqli_fetch_object($query)) {
							if (($row->name == "Most Popular") or ($row->name == "Phone Chat") or ($row->name == "Spy Shows")) {
							} else {
								if ($row->name == $_POST['Category'])
									echo '<option selected>' . $row->name . '</option>';
								else
									echo '<option>' . $row->name . '</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="col-md-2 register_content">
					<p>Race/Ethnicity </p>
				</div>
				<div class="col-md-10 footer_input_reg">
					<ul class="Race-Ethnicity">
						<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" value="African-American" /> African-American</li>
						<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" value="European" /> European</li>
						<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" value="Asian/East Asian" /> Asian/East Asian</li>
						<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" value="Latin" /> Latin</li>
						<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" value="Pacific Islander" /> Pacific Islander</li>
						<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" value="White/Caucasian" /> White/Caucasian</li>

					</ul>
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


						<?
						include("../dbase.php");
						include("../settings.php");
						?>


						<?php

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
					<?php
					if (isset($_POST['phone']) && $_POST['phone'] == "") {
						echo "<p class='errer'>Phone*</p>";
					} else {
						echo "<p>Phone*</p>";
					}
					?>
				</div>
				<div class="col-md-10 footer_input_reg">
					<input name="phone" value="<?php if (isset($_POST['phone'])) {
													echo $_POST['phone'];
												}  ?>" type="text" id="phone" size="24" maxlength="24" />
				</div>

				<div class="col-md-2 register_content">
					<?php
					if (isset($_POST['Adress']) && $_POST['Adress'] == "") {
						echo "<p class='errer'>Address*</p>";
					} else {
						echo "<p>Address*</p>";
					}
					?>
				</div>
				<div class="col-md-10 footer_input_reg">
					<textarea name="Adress" cols="24" rows="5" id="Adress"><?php if (isset($_POST['Adress'])) {
																				echo "$_POST[Adress]";
																			} ?></textarea>
				</div>




				<div class="col-md-2 register_content">


					<?php
					if (isset($_FILES['ImageFile']['name'])) {
						echo "<p class='errer'>Your Profile Picture*</p>";
					} else {
						echo "<p>Your Profile Picture*</p>";
					}
					?>
				</div>





				<div class="col-md-10 footer_input_reg">

					<input name="ImageFile" type="file" value="asdf" id="ImageFile" />


					<span class="form_informations style1">What users see when they browse.</span>
				</div>



				<div class="col-md-2 register_content">

					<?php
					if (isset($_FILES['ActImage']['name'])) {
						echo "<p class='errer'>Photo ID*</p>";
					} else {
						echo "<p>Photo ID*</p>";
					}
					?>

				</div>



				<div class="col-md-10 footer_input_reg">
					<input name="ActImage" type="file" value="" id="ActImage" />
					<span class="form_informations style1">Valid picture ID required.</span>

				</div>



				<div class="col-md-2 register_content">
					<?php
					if (isset($_FILES['RImage']['name'])) {
						echo "<p class='errer'>Your Picture*</p>";
					} else {
						echo "<p>Your Picture*</p>";
					}
					?>
				</div>



				<div class="col-md-10 footer_input_reg">
					<input name="RImage" type="file" value="" id="RImage" />
					<span class="form_informations style1">Picture of you with your picture ID. </span>
				</div>


				<div class="col-md-2 register_content">
				</div>

				<div class="col-md-10 buton_secc_bregister">
					<input type="submit" name="Submit" value=" I am at least 18 years of age" />
				</div>
			</div>
		</div>
	</div>
</form>



<?php include("_reg.footer.php"); ?>