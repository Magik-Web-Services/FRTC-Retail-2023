<?php
if (!isset($_SESSION)) {
	session_start();
}
if (isset($_GET['mdl_ext'])) {
	include("../../dbase.php");
	$userid = $_COOKIE['id'];
	mysqli_query($conn, "UPDATE chatmodels SET Spy_Shows='no' WHERE id='$userid'");
}
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype'] != "chatmodels") {
	header("location: ../../login.php");
} else {
	include("../../dbase.php");
	$result = mysqli_query($conn, "SELECT user from " . $_COOKIE['usertype'] . " WHERE id='" . $_COOKIE['id'] . "' LIMIT 1");
	while ($row = mysqli_fetch_array($result)) {
		$username = $row['user'];
	}
}

if (!isset($_COOKIE["id"])) {
	header("Location: ../../login.php");
} else if (isset($_POST['Email']) != "" && isset($_POST['gender']) != "" && isset($_POST['Name']) != "" && isset($_POST['Country']) != "" && isset($_POST['State']) != "" && isset($_POST['City']) != "" && isset($_POST['ZipCode']) != "" && isset($_POST['Adress']) != "") {
	include("../../dbase.php");
	$id = $_COOKIE["id"];
	$rult = mysqli_query($conn, "SELECT user from chatmodels WHERE id='$_COOKIE[id]' LIMIT 1");
	$rwqw = mysqli_fetch_array($rult);
	if ($username != "") {
		$tempUser = $username;
	} else {
		$tempUser = $rwqw['user'];
	}
	$tempPass1 = $_POST['Password1'];

	$tempPass2 = isset($_POST['Password2']);

	$tempEmail = $_POST['Email'];
	$tempgender = $_POST['gender'];

	$tL1 = isset($_POST['L1']);

	$tL2 = isset($_POST['L2']);

	$tL3 = isset($_POST['L3']);

	$tL4 = isset($_POST['L4']);

	$tDay = isset($_POST['day']);

	$tMonth = isset($_POST['month']);

	$tYear = isset($_POST['year']);

	$tBraS = isset($_POST['BraSize']);

	$tBirthS = isset($_POST['BirthSign']);

	$tEthnic = isset($_POST['Ethnic']);

	$tEyeC = isset($_POST['eyeColor']);

	$tHeight = isset($_POST['Height']);

	$tWeight = isset($_POST['Weight']);

	$tHeightM = isset($_POST['heightMeasure']);

	$tWeightM = isset($_POST['weightMeasure']);

	$tMessage = isset($_POST['Message']);

	$tFantasies = isset($_POST['Fantasies']);

	$tPosition = isset($_POST['Position']);



	$tCategory = isset($_POST['Category']);

	$tCPM = isset($_POST['CPM']);



	$tempName = isset($_POST['Name']);

	$tempCountry = isset($_POST['Country']);

	$tempState = isset($_POST['State']);

	$tempCity = isset($_POST['City']);

	$tempZip = isset($_POST['ZipCode']);

	$tempAdress = isset($_POST['Adress']);

	$tempPMethod = isset($_POST['PMethod']);

	$tempPInfo = isset($_POST['PInfo']);

	$tempIdmonth = isset($_POST['idmonth']);

	$tempIdyear = isset($_POST['idyear']);

	$tempIdtype = isset($_POST['idtype']);

	$tempIdnumber = isset($_POST['idnumber']);

	$tempSs = isset($_POST['ssnumber']);

	$tempPhone = isset($_POST['phone']);

	$tempBirth = isset($_POST['birthplace']);

	$tempYahoo = isset($_POST['yahoo']);

	$tempMsn = isset($_POST['msn']);

	$tempIcq = isset($_POST['icq']);

	$tHcolor = isset($_POST['hairColor']);

	$tHlength = isset($_POST['hairLength']);

	$tPhair = isset($_POST['pubicHair']);

	$tBfrom = isset($_POST['broadcastplace']);

	$tHobbies = isset($_POST['hobby']);

	$tFax = isset($_POST['fax']);
	if (isset($_POST['whocanchat'])) {
		$whocanchat = ", whocanchat='yes'";
	} else {
		$whocanchat = ", whocanchat='no'";
	}

	if (isset($_POST['makmyloc'])) {
		$makmyloc = ", makmyloc='yes'";
	} else {
		$makmyloc = ", makmyloc='no'";
	}
	if (isset($_POST["race_ethnicity"])) {
		$race_ethnicity = implode(", ", $_POST["race_ethnicity"]);
	}
	else{
		$race_ethnicity="";
	}
	if (isset($_POST["native_language"])) {
		$native_language = implode(", ", $_POST["native_language"]);
	}
	else {
		$native_language ="";
	}
	$monday = implode('-', $_POST['monday']);
	$tuesday = implode('-', $_POST['tuesday']);
	$wednesday = implode('-', $_POST['wednesday']);
	$thursday = implode('-', $_POST['thursday']);
	$friday = implode('-', $_POST['friday']);
	$saturday = implode('-', $_POST['saturday']);
	$sunday = implode('-', $_POST['sunday']);

	//birth date as String

	$currentSeconds = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];


	//$currentSeconds=strtotime($day." ".$_POST[month]." ".$_POST[year]);


	mysqli_query($conn, "UPDATE chatmodels SET monday='$monday',tuesday='$tuesday',wednesday='$wednesday',thursday='$thursday',friday='$friday',saturday='$saturday',sunday='$sunday',hobby='$tHobbies', broadcastplace='$tBfrom', pubicHair='$tPhair', hairLength='$tHlength', hairColor='$tHcolor', fax='$tFax', icq='$tempIcq', msn='$tempMsn', yahoo='$tempYahoo', birthplace='$tempBirth', phone='$tempPhone',ssnumber='$tempSs', idnumber='$tempIdnumber', idmonth='$tempIdmonth',idyear='$tempIdyear',idtype='$tempIdtype', email='$tempEmail', language1='$tL1', language2='$tL2', language3='$tL3', language4='$tL4',birthDate='$currentSeconds', braSize='$tBraS', birthSign='$tBirthS', weight='$tWeight', height='$tHeight', weightMeasure='$tWeightM', heightMeasure='$tHeightM', eyeColor='$tEyeC', ethnicity='$tEthnic', message='$tMessage', position='$tPosition', fantasies='$tFantasies', category='$tCategory', gender='$tempgender', name='$tempName', country='$tempCountry', state='$tempState', city='$tempCity', zip='$tempZip', adress='$tempAdress', pMethod='$tempPMethod', pInfo='$tempPInfo', race_ethnicity='$race_ethnicity', native_language='$native_language' $whocanchat $makmyloc WHERE id = '$id' LIMIT 1");



	if ($_POST['Password1'] != "") {

		$db_pass = md5($_POST['Password1']);

		mysqli_query($conn, "UPDATE chatmodels SET password='$db_pass' WHERE id = '$id' LIMIT 1");
	}


	mysqli_query($conn, "DELETE  from blockedcountry where model='$tempUser' ");
	//echo $tempUser;
	//die('sdf');
	foreach ($_POST['country'] as $cc) {
		$re1lt1 = mysqli_query($conn, "SELECT * FROM country where country_code='$cc'");
		$r23ow1 = mysqli_fetch_object($re1lt1);
		$cuntry_nm = $r23ow1->country_name;
		mysqli_query($conn, "INSERT INTO blockedcountry (model,cc,name)values('$tempUser','$cc','$cuntry_nm');");
	}



	mysqli_query($conn, "DELETE from blockedstates where model='$tempUser' ");
	foreach ($_POST['state'] as $cc) {
		$re1lt = mysqli_query($conn, "SELECT * FROM states where states='$cc'");
		$r23ow = mysqli_fetch_object($re1lt);
		$states_cd = $r23ow->states_code;
		mysqli_query($conn, "INSERT INTO blockedstates (model,cc,states_code)values('$tempUser','$cc','$states_cd');");
	}


	mysqli_query($conn, "UPDATE chatmodels SET category='$tCategory' WHERE id = '$id' LIMIT 1");

	$errorMsg = "<div style='color:#FFF;padding:15px;background-color:#4BB543;width:80%;margin:auto;margin-bottom:10px;font-weight:700;font-size: 16px;'>Profile update was successful.</div>";
} else if (!isset($_POST['Password1'])) //if we need to laod the variables from the database

{
	include("../../dbase.php");
	$result = mysqli_query($conn, "SELECT user from chatmodels WHERE id='" . $_COOKIE['id'] . "' LIMIT 1");
	$row = mysqli_fetch_array($result);
	$username = $row['user'];
	if (isset($_FILES['ImageFile']['tmp_name'])) {

		// unlink("../../models/" . $username . "/thumbnail.jpg");

		$digits = 5;
		$new_site = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

		// rand(6,100);
		// $_COOKIE['img']=$new_site;



		$urlThumbnail = "../../models/" . $username . "/thumbnail.jpg";
		$urlThumbnaila = "../../models/" . $username . "/" . $new_site . "thumbnail.jpg";
		if ($check = getimagesize($_FILES['ImageFile']['tmp_name'])) {
			$src = imagecreatefromstring(file_get_contents($_FILES['ImageFile']['tmp_name']));
			$theight = 910;
			$twidth = 620;
			$tmp = imagecreatetruecolor($theight, $twidth);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $theight, $twidth, $check[0], $check[1]);
			imagejpeg($tmp, $urlThumbnail, 100);
			$errorMsg = "Changed Successfully";


			$src = imagecreatefromstring(file_get_contents($_FILES['ImageFile']['tmp_name']));
			$theight = 250;
			$twidth = 200;
			$tmp = imagecreatetruecolor($theight, $twidth);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $theight, $twidth, $check[0], $check[1]);
			imagejpeg($tmp, $urlThumbnaila, 100);
			$errorMsg = "Changed Successfully";

			$_SESSION['img'] = $new_site;
		} else {
			$errorMsg = "File not Copied";
		}
	}
	include("../../dbase.php");

	$id = $_COOKIE["id"];

	$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE id='" . $id . "'");

	while ($row = mysqli_fetch_array($result)) {

		$tempUser = $row["user"];

		$tempPass1 = $row["password"];

		$tempPass2 = $row["password"];

		$tempEmail = $row["email"];
		$tempgender = $row["gender"];

		$tL1 = $row["language1"];

		$tL2 = $row["language2"];

		$tL3 = $row["language3"];

		$tL4 = $row["language4"];

		$tBirth = explode('/', $row["birthDate"]);

		$tDay = $tBirth[0];

		$tMonth = $tBirth[1];

		$tYear = $tBirth[2];

		$tBraS = $row["braSize"];

		$tBirthS = $row["birthSign"];

		$tMessage = $row["message"];

		$tFantasies = $row["fantasies"];

		$tPosition = $row["position"];

		$tEthnic = $row["ethnicity"];

		$tEyeC = $row["eyeColor"];

		$tHeight = $row["height"];

		$tWeight = $row["weight"];

		$tHeightM = $row["heightMeasure"];

		$tWeightM = $row["weightMeasure"];

		$tCPM = $row["cpm"];

		$tCategory = $row["category"];

		$tempName = $row["name"];

		$tempCountry = $row["country"];

		$tempState = $row["state"];

		$tempZip = $row["zip"];

		$tempCity = $row["city"];

		$tempAdress = $row["adress"];

		$tempPMethod = $row["pMethod"];

		$tempPInfo = $row["pInfo"];

		$tempIdmonth = $row['idmonth'];

		$tempIdyear = $row['idyear'];

		$tempIdtype = $row['idtype'];

		$tempIdnumber = $row['idnumber'];

		$tempSs = $row['ssnumber'];

		$tempPhone = $row['phone'];

		$tempBirth = $row['birthplace'];

		$tempYahoo = $row['yahoo'];

		$tempMsn = $row['msn'];

		$tempIcq = $row['icq'];

		$tHcolor = $row['hairColor'];

		$tHlength = $row['hairLength'];

		$tPhair = $row['pubicHair'];

		$tBfrom = $row['broadcastplace'];

		$tHobbies = $row['hobby'];

		$tFax = $row['fax'];
		$whocanchat = $row['whocanchat'];
		$makmyloc = $row['makmyloc'];
	}
	mysqli_free_result($result);
	
} else {

	$id = $_COOKIE["id"];

	$tempUser = $username;

	$tempPass1 = $_POST['Password1'];

	$tempPass2 = $_POST['Password2'];

	$tempEmail = $_POST['Email'];

	$tempgender = $_POST['gender'];



	$tL1 = $_POST['L1'];

	$tL2 = $_POST['L2'];

	$tL3 = $_POST['L3'];

	$tL4 = $_POST['L4'];



	$tDay = $_POST['day'];

	$tMonth = $_POST['month'];

	$tYear = $_POST['year'];



	$tBraS = $_POST['BraSize'];

	$tBirthS = $_POST['BirthSign'];



	$tEthnic = $_POST['Ethnic'];

	$tEyeC = $_POST['eyeColor'];

	$tHeight = $_POST['Height'];

	$tWeight = $_POST['Weight'];

	$tHeightM = $_POST['heightMeasure'];

	$tWeightM = $_POST['weightMeasure'];



	$tMessage = $_POST['Message'];

	$tFantasies = $_POST['Fantasies'];

	$tPosition = $_POST['Position'];



	$tCategory = $_POST['Category'];

	$tCPM = $_POST['CPM'];





	$tempName = $_POST['Name'];

	$tempCountry = $_POST['Country'];

	$tempState = $_POST['State'];

	$tempCity = $_POST['City'];

	$tempZip = $_POST['ZipCode'];

	$tempAdress = $_POST['Adress'];

	$tempPMethod = $_POST['PMethod'];

	$tempPInfo = $_POST['PInfo'];



	$tempIdmonth = $_POST['idmonth'];

	$tempIdyear = $_POST['idyear'];

	$tempIdtype = $_POST['idtype'];

	$tempIdnumber = $_POST['idnumber'];

	$tempSs = $_POST['ssnumber'];

	$tempPhone = $_POST['phone'];

	$tempBirth = $_POST['birthplace'];

	$tempYahoo = $_POST['yahoo'];

	$tempMsn = $_POST['msn'];

	$tempIcq = $_POST['icq'];



	$tHcolor = $_POST['hairColor'];

	$tHlength = $_POST['hairLength'];

	$tPhair = $_POST['pubicHair'];

	$tBfrom = $_POST['broadcastplace'];

	$tHobbies = $_POST['hobby'];

	$tFax = $_POST['fax'];
	$whocanchat = $_POST['whocanchat'];
	$makmyloc = $_POST['makmyloc'];
	$errorMsg = "Please complete the boxes withy the right specifications.";
}

$s_array = array('off', '12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm', '9pm', '10pm', '11pm');
$id = $_COOKIE["id"];
$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE id='" . $id . "'");

while ($row = mysqli_fetch_array($result)) {
	$monday = explode('-', isset($row['monday']));
	$tuesday = explode('-', isset($row['tuesday']));
	$wednesday = explode('-', isset($row['wednesday']));
	$thursday = explode('-', isset($row['thursday']));
	$friday = explode('-', isset($row['friday']));
	$saturday = explode('-', isset($row['saturday']));
	$sunday = explode('-', isset($row['sunday']));
}

include("_models.header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js?ver=3.3.1"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">
<script src="webcam.js"></script>
<script language="JavaScript">
	webcam.set_api_url('upload.php');
	webcam.set_quality(100); // JPEG quality (1 - 100)
	webcam.set_shutter_sound(true); // play shutter click sound


	// A $( document ).ready() block.
	$(document).ready(function() {
		$(".chosen-select").chosen({
			no_results_text: "Oops, nothing found!"
		});
	});
</script>
<script>
	function showStates() {
		var input_data1 = $('#Country').val();
		if (input_data1 == 236) {
			var input_data2 = "<div class='statessss'><select name='State' id='State_id' ><?php include("../dbase.php");
																							include("../settings.php");
																							$result = mysqli_query($conn, 'SELECT * FROM states ORDER BY id');
																							while ($row = mysqli_fetch_array($result)) {
																								echo "<option value='$row[states]'";
																								if (isset($_POST['states']) && $_POST['states'] == $row['states']) {
																									echo "selected";
																								}
																								echo ">$row[states]</option>";
																							}
																							mysqli_free_result($result); ?></select></div>";
			$(".showing_states").html(input_data2);
		} else {
			var input_data2 = "<div class='statessss'><input name='State' type='text' id='State' value='<?php echo $tempState; ?>' size='24' maxlength='24'></div>";
			$(".showing_states").html(input_data2);
		}
	}
</script>
<style type="text/css">
	.chosen-container .chosen-drop {
		background: #8F0000;
	}

	#gender {
		width: 20%;
		margin: 0 0 10px;
		height: 30px;
	}

	.chosen-container .chosen-drop {
		width: 40% !important;
	}

	.msg-areaa {
		width: 40px !important;
		text-align: center;
		margin-left: 1px !important;
	}

	input#whocanchat {
		width: auto;
		height: auto;
		margin-right: 6px 0 5px 0 !important;
		padding: 0;
	}

	input#makmyloc {
		width: auto;
		height: auto;
		margin-right: 6px 0 5px 0 !important;
		padding: 0;
	}
</style>
<?php
if (($tempgender == "Female") or ($tempgender == "TMTOF")) { ?>
	<style>
		.button_input_ec_model input {
			background: #fb41b5;
			border: none;
			color: #fff;
			border-radius: 4px;
			padding: 8px;
			width: 81px;
		}
	</style>
<?php } else if (($tempgender == "Male") or ($tempgender == "TFTOM")) { ?>
	<style>
		.button_input_ec_model input {
			background: #05b0fa;
			border: none;
			color: #fff;
			border-radius: 4px;
			padding: 8px;
			width: 81px;
		}
	</style>
<?php }	?>
<div class="main-container-uploadt-image ">
	<form action="updateprofile.php" method="post" enctype="multipart/form-data" name="form2" class="chatmodal_updateprofile">
		<div class="error"><?php if (isset($errorMsg) && $errorMsg != "") {
								echo $errorMsg;
							} ?></div>
		<div class="col-md-12 main_chatmodel_secc_bars">
			<div class="col-md-4 col-sm-4 col-xs-12 current_thumailll_secc_top">
				<div align="updated_picture">
					<?php

					if (isset($_FILES['ImageFile']['name'])) { ?>

						<img id="pic" src="../../models/<?php echo $username; ?>/<?php echo $new_site; ?>thumbnail.jpg">
						<?php } else {

						if (isset($_SESSION['img'])) {
						?>
							<img id="pic" src="../../models/<?php echo $username; ?>/<?php echo $_SESSION['img']; ?>thumbnail.jpg">
						<?php
						} else {
						?><img id="pic" src="../../models/<?php echo $username; ?>/thumbnail.jpg"><?php
																								}
																							}
																									?>
					<span>Current thumbnail image.<span>
				</div>
			</div>



			<div class="col-md-4 col-sm-4 col-xs-12 current_thumailll_secc_bottom">
				<div class="update-pic-page computer_from_images_sec">
					<span class="upload_seccc">Upload an image from your computer.</span>
					<input name="ImageFile" id="ImageFile" type="file">
					<?php if (($tempgender == "Female") or ($tempgender == "TMTOF")) { ?>
						<input name="image" src="../../images/update-btngirl.png" alt="" class="computer_sec_main" type="image">
					<?php } else if (($tempgender == "Male") or ($tempgender == "TFTOM")) { ?>
						<input name="image" src="../../images/update-btnboy.png" alt="" class="computer_sec_main" type="image">
					<?php }	?>
				</div>
			</div>
		</div>
	</form>
	<div class="update_profile_seciton_sec">
		<form name="form1" method="post" action="updateprofile.php">
			<div class="first_seciton_update">
				<span class="form_header_title">User Information </span>
				<div class="col-md-12 informatin_user">
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>User name : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side"><?php echo $tempUser; ?></div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>New Password : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Password1" type="password" id="Password1" size="24" maxlength="24">
							<span class="form_informations style1" style="margin-bottom:10px">
								Leave this blank unless you're changing your password.
							</span>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if ($tempEmail == "") {
								echo "<p class='error'>Email*</p>";
							} else {
								echo "<p>Email*</p>";
							}
							?>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Email" type="text" id="Email" value="<?php echo $tempEmail; ?>" size="24" maxlength="50">
						</div>
					</div>
				</div>
			</div>
			<div class="second_seciton_update">
				<span class="form_header_title">Profile Information</span>
				<div class="col-md-12  profile_infomation_sec_hh informatin_user">

					<div class="col-md-2">
						<label class="first_seciton_left_side">Spoken/written Language : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<ul class="Race-Ethnicity">
								<?php
								$idddd1 = $_COOKIE["id"];
								$resultet1 = mysqli_query($conn, "SELECT * FROM chatmodels WHERE id='$idddd1'");
								$rowet1 = mysqli_fetch_array($resultet1);
								$array1 =  explode(', ', $rowet1['native_language']);
								//echo $array;
								//print_r($array);
								?>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="English" <?php if (in_array('English', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> English</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Dutch" <?php if (in_array('Dutch', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> Dutch</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="French" <?php if (in_array('French', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> French</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Latin" <?php if (in_array('Latin', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> Latin</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="German" <?php if (in_array('German', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> German</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Italian" <?php if (in_array('Italian', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> Italian</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Japanese" <?php if (in_array('Japanese', $array1, true)) {
																																	echo "checked='checked'";
																																} ?> /> Japanese</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Korean" <?php if (in_array('Korean', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> Korean</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Portuguese" <?php if (in_array('Portuguese', $array1, true)) {
																																	echo "checked='checked'";
																																} ?> /> Portuguese</li>
								<li><input name="native_language[]" class="native_language" type="checkbox" value="Spanish" <?php if (in_array('Spanish', $array1, true)) {
																																echo "checked='checked'";
																															} ?> /> Spanish</li>
							</ul>
							<!--select name="L1" id="select2">
								<option value="Dutch"  <?php if ($tL1 == "Dutch") {
															echo "selected";
														} ?> >Dutch</option>
								<option value="English" <?php if ($tL1 == "English") {
															echo "selected";
														} ?> >English</option>
								<option value="French" <?php if ($tL1 == "French") {
															echo "selected";
														} ?> >French</option>
								<option value="German" <?php if ($tL1 == "German") {
															echo "selected";
														} ?> >German</option>
								<option value="Italian" <?php if ($tL1 == "Italian") {
															echo "selected";
														} ?> >Italian</option>
								<option value="Japanese" <?php if ($tL1 == "Japanese") {
																echo "selected";
															} ?> >Japanese</option>
								<option value="Korean" <?php if ($tL1 == "Korean") {
															echo "selected";
														} ?> >Korean</option>
								<option value="Portuguese" <?php if ($tL1 == "Portuguese") {
																echo "selected";
															} ?> >Portuguese</option>
								<option value="Spanish" <?php if ($tL1 == "Portuguese") {
															echo "selected";
														} ?> >Spanish</option>
							</select-->
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">Birth Date:* </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="day" id="day">
								<?php
								for ($i = 1; $i <= 31; $i++) {
									if ($i < 9) {
										$a = $i;
										$i = '0' . $i;
									}
									echo "<option value='$i'";
									if ($tDay == $i) {
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
								<option value="Jan" <?php if ($tMonth == "Jan") {
														echo "selected";
													} ?>>January</option>
								<option value="Feb" <?php if ($tMonth == "Feb") {
														echo "selected";
													} ?>>February</option>
								<option value="Mar" <?php if ($tMonth == "Mar") {
														echo "selected";
													} ?>>March</option>
								<option value="Apr" <?php if ($tMonth == "Apr") {
														echo "selected";
													} ?>>April</option>
								<option value="May" <?php if ($tMonth == "May") {
														echo "selected";
													} ?>>May</option>
								<option value="Jun" <?php if ($tMonth == "Jun") {
														echo "selected";
													} ?>>June</option>
								<option value="Jul" <?php if ($tMonth == "Jul") {
														echo "selected";
													} ?>>July</option>
								<option value="Aug" <?php if ($tMonth == "Aug") {
														echo "selected";
													} ?>>August</option>
								<option value="Sep" <?php if ($tMonth == "Sep") {
														echo "selected";
													} ?>>September</option>
								<option value="Oct" <?php if ($tMonth == "Oct") {
														echo "selected";
													} ?>>October</option>
								<option value="Nov" <?php if ($tMonth == "Nov") {
														echo "selected";
													} ?>>November</option>
								<option value="Dec" <?php if ($tMonth == "Dec") {
														echo "selected";
													} ?>>December</option>
							</select>
							<select name="year" id="year">
								<?php
								for ($i = 1950; $i <= date('Y') - 17; $i++) {
									echo "<option value='$i'";
									if ($tYear == $i) {
										echo "selected";
									}
									echo ">$i</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">Category : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="Category" id="select">
								<?php
								$query = mysqli_query($conn, "select * from category order by name asc");
								while ($row = mysqli_fetch_object($query)) {
									if (($row->name == "Most Popular") or ($row->name == "Phone Chat") or ($row->name == "Spy Shows")) {
									} else {
										if ($row->name == $tCategory)
											echo '<option selected>' . $row->name . '</option>';
										else
											echo '<option>' . $row->name . '</option>';
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<p>Gender*</p>
					</div>
					<div class="col-md-10 ">
						<select name="gender" id="gender">
							<option value='Male' <?php if ($tempgender == "Male") {
														echo "selected='selected'";
													} ?>>Male</option>
							<option value='Female' <?php if ($tempgender == "Female") {
														echo "selected='selected'";
													} ?>>Female</option>
							<option value='TMTOF' <?php if ($tempgender == "TMTOF") {
														echo "selected='selected'";
													} ?>>Trans Male To Female</option>
							<option value='TFTOM' <?php if ($tempgender == "TFTOM") {
														echo "selected='selected'";
													} ?>>Trans Female To Male</option>
						</select>
					</div>
					<div class="col-md-2">
						<p>Race/Ethnicity</p>
					</div>
					<div class="col-md-10 ">
						<ul class="Race-Ethnicity">
							<?php
							$idddd = $_COOKIE["id"];
							$resultet = mysqli_query($conn, "SELECT * FROM chatmodels WHERE id='$idddd'");
							$rowet = mysqli_fetch_array($resultet);
							$array =  explode(', ', $rowet['race_ethnicity']);
							//echo $array;
							//print_r($array);


							?>
							<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" <?php if (in_array('African-American', $array, true)) {
																											echo "checked='checked'";
																										} ?> value="African-American" /> African-American</li>

							<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" <?php if (in_array('European', $array, true)) {
																											echo "checked='checked'";
																										} ?> value="European" /> European</li>
							<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" <?php if (in_array('Asian/East Asian', $array, true)) {
																											echo "checked='checked'";
																										} ?> value="Asian/East Asian" /> Asian/East Asian</li>
							<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" <?php if (in_array('Latin', $array, true)) {
																											echo "checked='checked'";
																										} ?> value="Latin" /> Latin</li>
							<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" <?php if (in_array('Pacific Islander', $array, true)) {
																											echo "checked='checked'";
																										} ?> value="Pacific Islander" /> Pacific Islander</li>
							<li><input name="race_ethnicity[]" class="race-ethnicity" type="checkbox" <?php if (in_array('White/Caucasian', $array, true)) {
																											echo "checked='checked'";
																										} ?> value="White/Caucasian" /> White/Caucasian</li>
						</ul>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">Location : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="broadcastplace" type="text" id="broadcastplace" size="24" value="<?php if (isset($tBfrom)) {
																												echo $tBfrom;
																											}  ?>" maxlength="24">
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">Block Countries : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="country[]" multiple class="chosen-select" data-placeholder="Choose countries">
								<?php
								$result = mysqli_query($conn, "SELECT c.*,b.id as status FROM country c left join  (select * from blockedcountry where model='$username') b on b.cc=c.country_code ORDER BY c.country_name");

								while ($row = mysqli_fetch_object($result)) {
									echo '<option ' . ($row->status ? 'selected' : '') . ' value="' . $row->country_code . '">' . $row->country_name . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">Block States : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="state[]" multiple class="chosen-select" data-placeholder="Choose states">
								<?php
								$result = mysqli_query($conn, "SELECT c.*,b.id as status FROM states c left join  (select * from blockedstates where model='$username') b on b.cc=c.states group by states ORDER BY c.states");

								while ($row = mysqli_fetch_object($result)) {
									echo '<option ' . ($row->status ? 'selected' : '') . ' value="' . $row->states . '">' . $row->states . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side"> About Me : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<div align="">
								<input disabled maxlength="6" size="6" value="285" id="counter" class="msg-areaa">
								<textarea onkeyup="textCounter(this,'counter',285);" name="Message" cols="50" rows="8" id="Message"><?php echo $tMessage; ?></textarea>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="third_seciton_update">
				<span class="form_header_title">Schedule Information </span>
				<div class="col-md-12 shedule_sec informatin_user">
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Monday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="monday[]" id="monday">
								<?php
								foreach ($s_array as $s) {
									if ($monday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="monday[]" id="monday">
								<?php
								foreach ($s_array as $s) {
									if ($monday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Tuesday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="tuesday[]" id="tuesday">
								<?php
								foreach ($s_array as $s) {
									if ($tuesday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="tuesday[]" id="tuesday">
								<?php
								foreach ($s_array as $s) {
									if ($tuesday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Wednesday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="wednesday[]" id="wednesday">
								<?php
								foreach ($s_array as $s) {
									if ($wednesday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="wednesday[]" id="wednesday">
								<?php
								foreach ($s_array as $s) {
									if ($wednesday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Thursday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="thursday[]" id="thursday">
								<?php
								foreach ($s_array as $s) {
									if ($thursday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="thursday[]" id="thursday">
								<?php
								foreach ($s_array as $s) {
									if ($thursday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Friday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="friday[]" id="friday">
								<?php
								foreach ($s_array as $s) {
									if ($friday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="friday[]" id="friday">
								<?php
								foreach ($s_array as $s) {
									if ($friday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Saturday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="saturday[]" id="saturday">
								<?php
								foreach ($s_array as $s) {
									if ($saturday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="saturday[]" id="saturday">
								<?php
								foreach ($s_array as $s) {
									if ($saturday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Sunday : </p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="sunday[]" id="sunday">
								<?php
								foreach ($s_array as $s) {
									if ($sunday[0] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
							<select name="sunday[]" id="sunday">
								<?php
								foreach ($s_array as $s) {
									if ($sunday[1] == $s)
										echo '<option selected>' . $s . '</option>';
									else
										echo '<option>' . $s . '</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<p>Do not allow members to chat without tokens:</p>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input type="checkbox" name="whocanchat" id="whocanchat" <?php if ($whocanchat == "yes") {
																							echo "checked='checked'";
																						} ?>>
						</div>
					</div>
					<div style="clear:both; margin-top:10px;"><br>

						<div class="col-md-2">
							<label class="first_seciton_left_side">
								<p>Mask my location : </p>
							</label>
						</div>
						<div class="col-md-10">
							<div class="first_seciton_right_side">
								<input type="checkbox" name="makmyloc" id="makmyloc" <?php if ($makmyloc == "yes") {
																							echo "checked='checked'";
																						} ?>>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="fourth_seciton_update">
				<span class="form_header_title">Personal Information </span>
				<div class="col-md-12 personal_sec informatin_user">
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if ($tempName == "") {
								echo "<p class='error'>Full Name: *</p>";
							} else {
								echo "<p>Full Name: *</p>";
							}
							?>

						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="Name" type="text" id="Name" value="<?php echo $tempName; ?>" size="24" maxlength="24">
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">Country : *</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="Country" id="Country" onchange="showStates()">
								<?php
								include("../../dbase.php");
								include("../../settings.php");
								$result = mysqli_query($conn, 'SELECT * FROM countries ORDER BY name');
								while ($row = mysqli_fetch_array($result)) {
									echo "<option value='$row[id]'";
									if ($tempCountry == $row['id']) {
										echo "selected";
									}
									echo ">$row[name]</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if ($tempState == "") {
								echo "<p class='error'>State : * </p>";
							} else {
								echo "<p>State: * </p>";
							}
							?>
						</label>
					</div>
					<div class="col-md-10">

						<div class="first_seciton_right_side showing_states">
							<?php
							include("../../dbase.php");
							include("../../settings.php");
							$resultss1 = mysqli_query($conn, 'SELECT * FROM states where states="' . $tempState . '" ORDER BY id');
							$rowss1 = mysqli_num_rows($resultss1);
							if ($rowss1 > 0) {
							?>
								<select name="State" id="State_id">
									<?php
									$result = mysqli_query($conn, 'SELECT * FROM states ORDER BY id');
									while ($row = mysqli_fetch_array($result)) {
										echo "<option value='$row[states]'";
										if ($tempState == $row['states']) {
											echo "selected";
										}
										echo ">$row[states]</option>";
									}
									?>
								</select>
							<?php } else { ?>
								<input name="State" type="text" id="State" value="<?php echo $tempState; ?>" size="24" maxlength="24">
							<?php } ?>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if ($tempCity == "") {
								echo "<p class='error'>City : * </p>";
							} else {
								echo "<p>City : * </p>";
							}
							?>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="City" type="text" id="City" value="<?php echo $tempCity; ?>" size="24" maxlength="24">
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if ($tempZip == "") {
								echo "<p class='error'>Zip Code : *</p>";
							} else {
								echo "<p>Zip Code : *</p>";
							}
							?>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="ZipCode" type="text" id="ZipCode" value="<?php echo $tempZip; ?>" size="24" maxlength="24">
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if (isset($tempPhone) && $tempPhone == "") {
								echo "<p class='error'>Phone : *</p>";
							} else {
								echo "<p>Phone : *</p>";
							}
							?>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="phone" value="<?php if (isset($tempPhone)) {
															echo $tempPhone;
														}  ?>" type="text" id="phone" size="24" maxlength="24">
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">
							<?php
							if ($tempAdress) {
								echo "<p class='error'>Address : *</p>";
							} else {
								echo "<p>Address : *</p>";
							}
							?>
						</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<textarea name="Adress" cols="24" rows="5" id="Adress"><?php echo $tempAdress; ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="fifth_seciton_update">
				<span class="form_header_title">Payout Information </span>
				<div class="col-md-12 payouet_infoenation informatin_user">
					<div class="col-md-2">
						<label class="first_seciton_left_side">Payout Method :</label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<select name="PMethod" id="PMethod">
								<option value="pp" <?php if ($tempPMethod == "pp") {
														echo "selected";
													} ?>>Paypal</option>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="first_seciton_left_side">PayPal Email : </label>
					</div>
					<div class="col-md-10">
						<div class="first_seciton_right_side">
							<input name="PInfo" type="text" id="PInfo" value="<?php echo $tempPInfo; ?>" size="24" />
						</div>
					</div>
					<div class="col-md-12 upated_all informatin_user">

						<?php if (($tempgender == "Female") or ($tempgender == "TMTOF")) { ?>
							<input name="image2" src="../../images/update-btngirl.png" alt="" class="computer_sec_main" type="image">
						<?php } else if (($tempgender == "Male") or ($tempgender == "TFTOM")) { ?>
							<input name="image2" src="../../images/update-btnboy.png" alt="" class="computer_sec_main" type="image">
						<?php }	?>
						<a href="javascript:history.go(-1)"></a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include("_models.footer.php"); ?>