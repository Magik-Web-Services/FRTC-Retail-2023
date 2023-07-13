<?php
include("_header-admin.php")
?>


<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1">
	<tr>
		<td>
			<p><?php

				//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
				//$secondsAll=time();

				include('../dbase.php');

				?>

				<?php
				function GetAge($Birthdate)
				#
				{
					#
					// Explode the date into meaningful variables
					#
					list($BirthDay, $BirthMonth, $BirthYear) = explode("/", $Birthdate);
					echo $BirthMonth;
					#
					// Find the differences
					#
					$YearDiff = date("Y") - $BirthYear;
					// #
					$MonthDiff = date("m");
					#
					$DayDiff = date("d") - $BirthDay;
					#
					// If the birthday has not occured this year
					#
					if ($DayDiff < 0 || $MonthDiff < 0)
						#
						$YearDiff--;
					#
					return $YearDiff;
					#
				}
				?>

				<?php





				$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE id='$_GET[id]' LIMIT 1");

				while ($row = mysqli_fetch_array($result)) {
					$tempUser = $row["user"];
					$tempPass1 = $row["password"];
					$tempPass2 = $row["password"];
					$tempEmail = $row["email"];
					//$tEthnic=$row["race_ethnicity"];
					$tL1 = $row["language1"];
					$tL2 = $row["language2"];
					$tL3 = $row["language3"];
					$tL4 = $row["language4"];

					$tBirthD = $row["birthDate"];
					$tBirthFull = $tBirthD;
					$tBirthD = GetAge($row["birthDate"]);


					$tBraS = $row["braSize"];
					$tBirthS = $row["birthSign"];
					$tMessage = $row["message"];
					$tFantasies = $row["fantasies"];
					$tPosition = $row["position"];
					$tEthnic = $row["race_ethnicity"];
					$tEyeC = $row["eyeColor"];
					$tHeight = $row["height"];
					$tWeight = $row["weight"];
					$tHeightM = $row["heightMeasure"];
					$tWeightM = $row["weightMeasure"];

					$tCPM = $row["cpm"];
					$tCategory = $row["category"];

					$tempName = $row["name"];
					$native_language =  $row['native_language'];
					$result3 = mysqli_query($conn, "SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
					while ($row3 = mysqli_fetch_array($result3)) {
						$tempCountry = $row3['name'];
					}

					$tempState = $row["state"];
					$tempZip = $row["zip"];
					$tempCity = $row["city"];
					$tempAdress = $row["adress"];
					$tempPMethod = $row["pMethod"];
					$tempPInfo = $row["pInfo"];
					$tOwner = $row["owner"];
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
					$tempFax = $row['fax'];
				}
				?>



			<table width="1017" align="center" style="margin-top:100px !important;">
				<tr>
					<td width="96" height="96" align="center" valign="middle">
						<div align="left"><img style="border:solid;border-width:5px;border-color:#e1e1e1;" height="200" width="250" src="../models/<?php echo $tempUser . "/thumbnail.jpg" ?>"></div>
					</td>

				</tr>
			</table>

			<div style="position:absolute;margin-top:-140px;margin-left:300px;color:#5e5e5e;border:solid;border-width:0.5px;border-color:#ddd;padding:5px;border-radius:4px;background-color:#fff;width:40%;border-radius:5px;box-shadow: 0px 2px 6px #d2d2d2;letter-spacing:0.5px;word-spacing:0.5px;">
				<h3 align="center"><b><?php echo $tempUser ?></b> has registered to become a broadcaster. </h3>
			</div>


			<br>
			<table width="1010" align="center" cellpadding="10" class="form_definitions">
				<tr>
					<td width="367"><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Screen Name:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempUser; ?></b></td>

				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Email:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#4b9aff;" margin-bottom:50px;><a href="mailto:<?php echo $tempEmail; ?>" style="color:#fff;"><?php echo $tempEmail; ?></b></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td width="600px"><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Native Language:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $native_language; ?></b> </td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Race:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tEthnic;   ?></b> </td>
					<td></td>
					<td>&nbsp;</td>
				</tr>

				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Full Name:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempName; ?><b></td>

					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Country:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempCountry; ?></b></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">State:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempState; ?></b></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">City:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempCity; ?></b></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Address:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempAdress; ?></b></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Zip Code:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempZip; ?></b></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Phone:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tempPhone; ?></b></td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b style="color:#ddd;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#333;">Birth Date:</b> <b style="color:#333;border:solid;border-width:0.5px;border-color:#999;padding:5px;border-radius:4px;background-color:#fff;"><?php echo $tBirthFull; ?></b> </td>
					<td>



					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
			</table>

			<table width="1010" border="0" align="center" cellpadding="4" cellspacing="0" class="form_definitions">
				<tr bgcolor="#ddd">
					<td width="357" bgcolor="#ddd"><strong>Approve Model </strong></td>
					<td width="637"><strong style="margin-left:50px;">Reject Model </strong></td>
				</tr>
				<tr bgcolor="#ececec">
					<td>
						<form name="form1" method="post" action="acceptsubmission.php">
							<p>Payout percentage<br>
								<input name="epc" type="text" id="epc" value="50" size="2" maxlength="2" style="margin-bottom:12px;">
								<br>
								Tokens per minute<br>
								<input name="cpm" type="text" id="cpm" value="10" size="3" maxlength="3">
								<br>
								<br>
								<input type="submit" name="Submit" value="Approve Broadcaster" style="cursor:pointer;">
								<input name="id" type="hidden" id="id4" value="<?php echo $_GET['id']; ?>">
								<input name="username" type="hidden" id="username3" value="<?php echo $tempUser; ?>">
								<input name="email" type="hidden" id="username" value="<?php echo $tempEmail; ?>">
								<input name="studio" type="hidden" id="email2" value="<?php echo  $tOwner; ?>">
							</p>
						</form>
					</td>

					<td bgcolor="#ececec"><b style="margin-left:50px;">Reason:</b>
						<form name="form1" method="post" action="rejectsubmission.php">
							<textarea name="Reason" cols="32" rows="4" id="textarea" style="margin-left:50px;margin-bottom:28px;"></textarea>
							<br>
							<input type="submit" name="Submit2" value="Reject Broadcaster" style="margin-left:50px;margin-bottom:0px;width:280px;cursor:pointer;">
							<input name="id" type="hidden" id="id22" value="<?php echo $_GET['id']; ?>">
							<input name="username" type="hidden" id="username22" value="<?php echo $tempUser; ?>">
							<input name="email" type="hidden" id="email" value="<?php echo $tempEmail; ?>">
							<input name="studio" type="hidden" id="studio" value="<?php echo  $tOwner; ?>">
						</form>
					</td>
				</tr>
			</table>
			<table width="1010" align="center" class="form_definitions">
				<tr>
					<td><strong>Copy of photo ID</strong></td>
				</tr>
				<tr>
					<td><img src="../models/<?php echo $tempUser . "/" . $_GET['id'] . ".jpg";  ?>" height="200" width="250"></td>
				</tr>
			</table>
			<table width="1010" align="center" class="form_definitions">
				<tr>
					<td><strong>Recorded photo of Broadcaster </strong></td>
				</tr>
				<tr>
					<td><img src="../models/<?php echo $tempUser . "/representative.jpg";  ?>" height="200" width="250"></td>
				</tr>
			</table> <br>
		</td>
	</tr>
</table>



<?php
include("_footer-admin.php")
?>