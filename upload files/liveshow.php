<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script type='text/javascript' src='js/jquery.lazyload.min.js'></script>
<?php

#
function GetAge($Birthdate)
#
{
	#
	// Explode the date into meaningful variables
	#
	list($BirthDay, $BirthMonth, $BirthYear) = explode("/", $Birthdate);
	#
	// Find the differences
	#
	$YearDiff = date("Y") - $BirthYear;
	#
	$MonthDiff = date("m") - $BirthMonth;
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
if (isset($_COOKIE["usertype"])) {
	include("_main.header.logged.in.php");
} else {
	include("_main.header.php");
}

if (isset($_POST['epc']) && isset($_POST['cpm'])) {
	include('dbase.php');
	include('settings.php');
	mysql_query("UPDATE chatmodels SET cpm='$_POST[cpm]',epercentage='$_POST[epc]' WHERE id = '$_POST[id]' LIMIT 1");
}


include('dbase.php');
$result = mysql_query("SELECT * FROM chatmodels WHERE user='$_GET[model]' AND status!='rejected' AND status!='blocked' AND status!='pending'  LIMIT 1");
while ($row = mysql_fetch_array($result)) {
	$tempUser = $row["user"];
	$tempPass1 = $row["password"];
	$tempPass2 = $row["password"];
	$tempEmail = $row["email"];
	$tempgender = $row["gender"];
	$status = $row['status'];
	$tL1 = $row["language1"];
	$tL2 = $row["language2"];
	$tL3 = $row["language3"];
	$tL4 = $row["language4"];

	$tBirthD = $row["birthDate"];
	$tBirthD = GetAge($row["birthDate"]);
	$tmaskloc = $row["makmyloc"];
	//   echo $row["birthDate"];
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

	$cpm = $row["cpm"];
	$epc = $row["epercentage"];
	$pay_per_mint = $row["pay_per_mint_script"];
	$payperminthtml = $row["pay_per_script_html"];
	$tCategory = $row["category"];
	$rowdate = $row["dateRegistered"];
	$date = date("d F Y,H:i", $rowdate);

	$tempName = $row["name"];

	$result3 = mysql_query("SELECT name FROM countries WHERE id='$row[country]' LIMIT 1");
	while ($row3 = mysql_fetch_array($result3)) {
		$tempCountry = $row3['name'];
	}

	$tempState = $row["state"];
	$tempZip = $row["zip"];
	$tempCity = $row["city"];
	$tempAdress = $row["adress"];
	$tempPMethod = $row["pMethod"];
	$tempPInfo = $row["pInfo"];
	$tOwner = $row['owner'];
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
	$tempFax = $row['fax'];
	$monday = $row['monday'];
	$tuesday = $row['tuesday'];
	$wednesday = $row['wednesday'];
	$thursday = $row['thursday'];
	$friday = $row['friday'];
	$saturday = $row['saturday'];
	$sunday = $row['sunday'];
} ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<div align="center">

	<head>



		<p>
			<script>
				$(document).ready(function() {


					$("img.lazy").lazyload({
						effect: "fadeIn",

						effectspeed: 1000
					}).removeClass("lazy");
					$('.showThumbnail').live('mouseleave', function() {
						var hiddenDiv = $(this).find(':last-child');

						hiddenDiv.css('display', 'none');

						hiddenDiv.html('');

						$(this).find(':first-child').css('display', 'block');
					});

					$(".fancybox").fancybox({
						openEffect: 'none',
						closeEffect: 'none'
					});
					$("#next").click(function() {
						<?php
						$row = mysql_fetch_object(mysql_query("SELECT user from chatmodels  WHERE user!='{$_GET[model]}' AND status!='rejected' AND status!='blocked' AND status!='pending'   ORDER BY RAND() LIMIT 1"));
						$next = $row->user;
						unset($row);
						?>
						window.location = 'liveshow.php?model=<?= $next; ?>';
					});

				});
				$(document).ready(function() {

					$("#biooo").fancybox({
						'onStart ': function() {
							$.fancybox.hideActivity();
						},
						'onComplete': function() {
							$.fancybox.hideActivity();
						},
						'autoSize': true,
						'openEffect': 'none',
						'padding': 0,
						'margin': 10,
						'scrolling': 'no',
						'transitionIn': 'fade',
						'transitionOut': 'fade',
						'titleShow': false,
						'overlayColor': '#8F0000',
						'overlayOpacity': 0.8,
						'closeBtn': false,
					}).trigger('click');
				});
				$(document).ready(function() {

					$(".showThumbnail").fancybox({
						'onStart ': function() {
							$.fancybox.hideActivity();
						},
						'onComplete': function() {
							$.fancybox.hideActivity();
						},
						'autoSize': true,
						'openEffect': 'none',
						'padding': 0,
						'margin': 10,
						'scrolling': 'no',
						'transitionIn': 'fade',
						'transitionOut': 'fade',
						'titleShow': false,
						'overlayColor': '#8F0000',
						'overlayOpacity': 0.8,
					});

				});

				function openchatbox(model) {
					alert(model);
				}
			</script>
	</head>
	<?php

	include("dbase.php");

	include("settings.php");

	$result = mysql_query("SELECT user from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

	while ($row = mysql_fetch_array($result)) {
		$username = $row['user'];
	}

	?>

	</p>
	<style type="text/css">
		body {
			background-color: #<? echo $mainSiteBackgroundColor;  ?> !important;

		}


		.col-md-2 {
			width: 200px;


		}




		.live_show_main_container {
			width: 90%;
			margin: 0 auto;
			display: table;
		}

		.live_show_submain_container {
			background-color: #00000030;
			/*  box-shadow: 0px 0px 3px #999; */
			margin: 29px 0px;
			padding: 30px 20px;
			float: left;
			width: 100%;
			margin-bottom: 150px;
			color: #fff;

		}

		.top-header-livehsow {
			background-color: #00000021;
			/*  box-shadow: 1px 1px 3px #999; */
			margin: 0px 0 30px 0;
			padding: 11px 20px;
			float: left;
			width: 100%;
			color: #fff;
		}

		.top-header-livehsow strong {
			float: left;
		}

		.top-header-livehsow ul#css3menu1 {
			float: right;
		}

		.top-header-livehsow ul#css3menu1 li {
			display: inline-block;
			float: left;
			margin-left: 15px;
		}

		.biosss ul li {
			width: 100%;
			line-height: 25px;
			float: left;
		}

		.biosss ul li p {
			width: 50%;
			float: left;
			margin: 0;
			text-align: left;
		}

		.biosss ul li span {
			float: right;
			width: 50%;
			text-align: left;
		}

		.biosss strong {
			text-align: left;
			width: 100%;
			float: left;
			padding-bottom: 11px;
		}

		.biosss ul li.topmenulivehsow a {
			color: #fff;
		}

		.biosss ul li.topmenulivehsow {
			float: left;
			width: auto;
			background-color: #00000036;
			padding: 2px 16px;
			margin-right: 10px;
			border-radius: 4px;
			margin-top: 10px;
		}

		.abooout strong {
			text-align: left;
			width: 100%;
			float: left;
			padding-bottom: 11px;
		}

		.abooout .mssg {
			text-align: left;
			float: left;
			margin-bottom: 10px;
		}

		.abooout li.topmenu.callbutton {
			margin-bottom: 33px;
			text-align: left;
		}

		.abooout .text-extenston {
			margin-bottom: 10px;
		}

		.abooout .paypermint {
			margin-bottom: 10px;
		}

		.scheduleee strong {
			text-align: left;
			width: 100%;
			float: left;
			padding-bottom: 11px;
		}

		.scheduleee ul {
			width: 100%;
			float: left;
		}

		.scheduleee ul li {
			width: 100%;
			float: left;
		}


		.scheduleee ul li {
			float: left;
			width: 100%;
		}

		.scheduleee ul li span {
			width: 50%;
			text-align: right;
			float: right;
		}

		.scheduleee ul li p {
			width: 50%;
			text-align: left;
			float: left;
		}

		.fisrt-secitonss {
			margin-bottom: 30px;
		}

		.myclsssss {
			margin-bottom: 20px;
		}

		.myslslsl {
			margin-bottom: 15px;
		}

		.rendom-performer {
			width: 100%;
			float: left;
			text-align: left;
			padding: 30px 18px 20px 15px;
			font-size: 16px;
			font-weight: bold;
		}

		div#layer span.card-title {
			float: left;
			width: 100%;
			background-color: #FFF;

		}


		div#layer span.card-name {
			color: #ffffff;

		}




		.viewss {
			float: left;
			width: 100%;
			background-color: #<? echo $thumbBarColor2 ?>;
			color: #<? echo $thumbTextColor ?>;
		}

		@media (max-width: 480px) {
			.myclsssss {
				width: 100%;
				float: left;
			}

			.chatWindow .chatRoom #messages {
				height: 250px !important;
			}
		}
	</style>
	<div class="live_show_main_container">
		<div class="live_show_submain_container">
			<div class="col-md-12 top-header-livehsow">
				<div class="col-md-6"><strong><?php echo $tempUser; ?></strong></div>
				<div class="col-md-6">
					<!--ul id="css3menu1" class="topmenu">
					<li class="topmenu">
					  <a href="javascript:history.go(-1)"> GO BACK </a>
					</li>
					<li class="topmenu">
					  <a id="next"> NEXT PERFORMER </a>
					</li>
				</ul-->
				</div>
			</div>
			<div class="col-md-12 fisrt-secitonss">
				<div class="col-md-3 col-sm-6 col-xs-12 myslslsl">
					<a class="showThumbnail oopsshere" href="liveshow.php?model=<? echo $tempUser; ?>" rel="<? echo $tempUser; ?>">
						<img class="lazy" src="models/<? echo $tempUser; ?>/thumbnail.jpg" src2="models/<? echo $tempUser; ?>/thumbnail.jpg" data-original="models/<? echo $tempUser; ?>/thumbnail.jpg" width="100%" height="" border="0">
					</a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 myslslsl biosss">
					<strong><?php echo $tempUser; ?>'s BIO</strong>
					<ul>
						<?php
						$result0101 = mysqli_query($conn, "SELECT * FROM chatmodels WHERE user='$_GET[model]' AND status!='rejected' AND status!='blocked' AND status!='pending'  LIMIT 1");
						$row0101 = mysqli_fetch_array($result0101);
						$array =  explode(', ', $row0101['race_ethnicity']);
						$native_language =  $row0101['native_language'];
						?>
						<li>
							<p>Race:</p> <span><?php echo $row0101['race_ethnicity'];   ?></span>
						</li>

						<li>
							<p>Age:</p> <span><?= $tBirthD; ?></span>
						</li>

						<li>
							<p>Gender:</p> <span><?php if ($tempgender == "Male") {
														echo "Male";
													} else if ($tempgender == "Female") {
														echo "Female";
													} else if ($tempgender == "TMTOF") {
														echo "Trans Male To Female";
													} else if ($tempgender == "TFTOM") {
														echo "Trans Female To Male";
													} ?></span>
						</li>

						<?php if ($tmaskloc == 'yes') { ?>
							<li>
								<p>Location:</p> <span>Private</span>
							</li>
						<?php } else { ?>
							<li>
								<p>Location:</p> <span><?= $tempCountry; ?></span>
							</li>
						<?php } ?>



						<li>
							<p>Spoken/written Language:</p> <span><?php echo $native_language; ?></span>
						</li>
						</span></li>
						<?php if (!$username) { ?>
							<li class="topmenulivehsow">
								<a class="bio" href="login_member.php" style="height:10px;line-height:10px;"> Follow </a>
							</li>
						<?php } else { ?>
							<li class="topmenulivehsow">
								<a class="bio" href="addfavourite.php?user=<? echo $tempUser ?>&ok=ok" style="height:10px;line-height:10px;"> Follow </a>
							</li>
						<?php } ?>
						<li class="topmenulivehsow">
							<a class="bio" href="liveshowchat.php?model=<? echo $tempUser ?>" id="bio" style="height:10px;line-height:10px;"> Live Chat </a>
						</li>

					</ul>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 myslslsl abooout">
					<strong>About Me </strong>
					<div class="mssg"><?= $tMessage; ?></div>
					<li class="topmenu callbutton">

						<div class="text-extenston">
							<?php echo $payperminthtml;  ?>
						</div>




						<div class="paypermint">

							<?
							if (empty($pay_per_mint)) {

								echo '';
							} else {

								echo 'Chat Extention:';
							}

							?>







							<?php echo $pay_per_mint; ?></br>
						</div>
					</li>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12 myslslsl scheduleee">
					<strong>My Schedule</strong>
					<ul>
						<li>
							<p>Monday:</p> <span><?php if ($monday) {
														echo $monday;
													} else {
														echo "Off";
													} ?></span>
						</li>
						<li>
							<p>Tuesday:
							<p> <span><?php if ($tuesday) {
											echo $tuesday;
										} else {
											echo "Off";
										} ?> </span>
						</li>
						<li>
							<p>Wednesday:</p> <span><?php if ($wednesday) {
														echo $wednesday;
													} else {
														echo "Off";
													} ?></span>
						</li>
						<li>
							<p>Thursday:</p> <span><?php if ($thursday) {
														echo $thursday;
													} else {
														echo "Off";
													} ?></span>
						</li>
						<li>
							<p>Friday:
							<p> <span><?php if ($friday) {
											echo $friday;
										} else {
											echo "Off";
										} ?></span>
						</li>
						<li>
							<p>Saturday:</p> <span><?php if ($saturday) {
														echo $saturday;
													} else {
														echo "Off";
													} ?></span>
						</li>
						<?php //if($sunday){ echo sunday; } 
						?>
						<li>
							<p>Sunday:</p> <span><?php if ($sunday) {
														echo $sunday;
													} else {
														echo "Off";
													} ?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12">

				<div class="col-md-12 top-header-livehsow">
					<div class="col-md-6"><strong><?php echo $tempUser; ?>'s Content</strong></div>
					<div class="col-md-6">

					</div>



					<?php
					if (isset($_COOKIE['usertype']) && $_COOKIE['usertype'] == "chatusers") {
						$result = mysql_query('SELECT cpm FROM chatmodels WHERE user="' . $_GET['model'] . '" LIMIT 1');
						while ($row = mysql_fetch_array($result)) {
							$cpm = $row['cpm'];
						}
						$result = mysql_query('SELECT id,user,money,freetime,freetimeexpired FROM chatusers WHERE id="' . $_COOKIE['id'] . '" LIMIT 1');
						while ($row = mysql_fetch_array($result)) {
							$freetime = $row['freetime'];
							$freetimeexpired = $row['freetimeexpired'];
							$sUser = $row['user'];
							$sId = $row['id'];
							$nMoney = $row['money'];
						}
						if ($freetime == 0 && (time() - $freetimeexpired) > (3600 * $freehours)) {
							mysql_query("UPDATE chatusers SET freetime='120', freetimeexpired='0' WHERE id='$_COOKIE[id]' LIMIT 1");
							$freetime = 110;
						}
						$result = mysql_query("SELECT * from favorites WHERE member='$sUser' AND model='$_GET[model]'");
						if (mysql_num_rows($result) >= 1) {
							$nFav = 1;
						} else {
							$nFav = 0;
						}
					} else {
						$sUser = "guest";
						$sId = "00";
						$nMoney = 0;
						$nFav = 0;
					}
					?>
				</div>


				<div class="col-md-12">
					<?php
					$count = 0;
					$result = mysql_query('SELECT * FROM modelpictures WHERE user="' . $tempUser . '" ORDER BY dateuploaded DESC');
					//$result = mysql_query('SELECT * FROM modelpictures ORDER BY dateuploaded DESC');
					while ($row = mysql_fetch_array($result)) {

						echo "
			<div class='col-md-2 col-sm-4 col-xs-4' align='center' valign='middle'>
				<div class='hoverbox'>
					<a class='fancybox' href='models/" . $tempUser . "/" . $row['name'] . ".jpg' rel='group'>
						<img src ='models/" . $tempUser . "/" . $row['name'] . "_thumbnail.jpg' data-lightbox='' border='0' width='100%' height='auto'>
					</a>
				</div>
			</div>";
						if ($count == 6) {
							echo "</tr>";
							$count = 0;
						}
					}
					mysql_free_result($result);
					?>
				</div>

				<div class="col-md-12">
					<div class="rendom-performer">Random Broadcasters</div>
				</div>


				<?php
				$count = 0;
				$result = mysql_query("SELECT * from chatusers WHERE id='" . $_COOKIE['id'] . "'");
				$rows = mysql_fetch_array($result);
				$result = mysql_query("SELECT * from countries WHERE id='" . $rows['country'] . "'");
				$rows_country = mysql_fetch_array($result);
				$result = mysql_query("SELECT * from states WHERE states='" . $rows['state'] . "'");
				$rows_state = mysql_fetch_array($result);
				$result = mysql_query("SELECT model from blockedcountry WHERE name='" . $rows_country['name'] . "'");
				$models = '';
				$modelsd = '';
				while ($row_model = mysql_fetch_array($result)) {
					$models = $row_model['model'];
					$modelsd .= " and user!='" . $models . "'";
				}
				$result = mysql_query("SELECT model from blockedstates WHERE states_code='" . $rows_state['states_code'] . "'");
				$models_s = '';
				$modelsd_s = '';
				while ($row_state_model = mysql_fetch_array($result)) {
					$modelss = $row_state_model['model'];
					$modelsd .= " and user!='" . $modelss . "'";
				}
				$result = mysql_query("SELECT * FROM chatmodels WHERE user!='$tempUser' AND status='online' $modelsd ORDER BY rand() LIMIT 50");
				while ($row = mysql_fetch_array($result)) {
					$gender = $row['gender'];
					$views = $row['views'];
					$phonechat = $row['phonechat'];
					if ($views == "") {
						$total_viewss = "0";
					} else {
						$total_viewss = $views;
					}
					if (($gender == "Female") or ($gender == "TMTOF")) {
						$femacls = "fe_color_change";
					} else if (($gender == "Male") or ($gender == "TFTOM")) {
						$femacls = "ma_color_change";
					}
					$htmll = "
				<div class='col-md-2 col-sm-4 col-xs-6 myclsssss' align='center' valign='middle'>
					<div id='layer'>
						<a class='showThumbnail' href='liveshowchat.php?model=" . $row['user'] . "' rel='" . $row['user'] . "'>
							<img class='lazy' src ='models/" . $row['user'] . "/thumbnail.jpg' border='0' width='100%'>
							<span class='card-title " . $femacls . "'>
							<span class='card-name'>" . $row['user'] . "</span>
							<span class='card-age' style='display:none;'>" . GetAge($row['birthDate']) . "/" . substr($row['gender'], 0, 1) . "</span>
							</span>
							<div class='viewss' style='display:none;'><span class='viewer'>Users (" . $total_viewss . ")</span><span class='maincam'><img class='camicon' src='images/camicon.png'></span>";

					if ($phonechat == 'yes') {

						$htmll .= 	'<span class="maincall" ><img class="callicon" src="images/callicon.png"></span>';
					}



					$htmll .= "</div>
						</a>
					</div>
				</div>";




					echo  $htmll;
				}
				mysqli_free_result($result);
				?>
			</div>


		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox();
		});
	</script>

	<map name="Map2" id="Map2">
		<area shape="rect" coords="13,12,180,51" href="#" />
	</map>

	<?php include("_main.footer.php"); ?>