<!DOCTYPE html>

<html lang="en">

<head>
	<?php
	include("../dbase.php");
	include("../settings.php");


	$nTime = time();
	//we set the status to offline to models that have not changed theyr status for 30 seconds
	mysqli_query($conn, "UPDATE chatmodels SET status='offline' WHERE $nTime-lastupdate>30 AND status!='rejected' AND status!='blocked' AND status!='pending' AND forcedOnline='0'");
	?>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	$query = mysqli_query($conn, "select * from category order by id asc");
	while ($row = mysqli_fetch_object($query)) {
		$cats[] = $row->name;
	}
	$cat_array = array_chunk($cats, 7);
	$columns = count($cat_array);
	?>



	<?php
	$query = mysqli_query($conn, "select * from category_top order by id asc");
	while ($row = mysqli_fetch_object($query)) {
		$cats_top[] = $row->name;
	}
	$cat_array_top = array_chunk($cats_top, 7);
	$columns_top = count($cat_array_top);
	?>





	<title><?php echo $sitename; ?></title>

	<!-- CSS  -->
	<link href="assets/css/cssnhd/bootstrap.css" type="text/css" rel="stylesheet">
	<link href="assets/css/cssnhd/style.css" type="text/css" rel="stylesheet">
	<link href="assets/css/font-awesomenhd/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/cssnhd/media.css" type="text/css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	<link rel="stylesheet" href="assets/css/style5.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		jQuery(document).ready(function() {
			$(window).scroll(function() {
				var sticky = $('.navbar-fixed'),
					scroll = $(window).scrollTop();

				if (scroll >= 100) sticky.addClass('fixed-headr');
				else sticky.removeClass('fixed-headr');
			});
			$(window).scroll(function() {
				var sticky = $('.bgsgsgcls'),
					scroll = $(window).scrollTop();

				if (scroll >= 100) sticky.addClass('fixed-headr');


				else sticky.removeClass('fixed-headr');
			});
		});

		function myFunction() {
			var x = document.getElementById("myTopnav");
			if (x.className === "topnav") {
				x.className += " responsive";
			} else {
				x.className = "topnav";
			}
		}
	</script>
	<script>
		$(document).ready(function() {
			$(".drop_manu").hide();
			$(".dropdown-toggle.hide_sec").click(function() {
				jQuery(".drop_manu").toggal('');
			});
		});
	</script>

	<script type="text/javascript">
		jQuery(document).ready(function() {

		});
	</script>
</head>

<body>

	<div class="navbar-fixed">
		<nav class="pinkcs desktopmenu" role="navigation">
			<div class="nav-wrapper">
				<tr>
					<td class="top-right-td" valign="top"><!-- Start css3menu.com BODY section -->
						<ul id="css3menu1" class="topmenu headermaintopleft col-md-3">
							<li class="topmenu col-md-12 col-sm-6">
								<center><a href="<?php echo $siteurl ?>"><img src="../images/logo1.png"></a></center>
							</li>
							<li class="topmenu  col-md-6 col-sm-6">
							</li>
						</ul>

					</td>
					<td class="top-left-td" valign="top" align="right"><!-- Start css3menu.com BODY section -->
						<ul id="css3menu1" class="col-md-5 col-sm-12 topmenu hhhhhff">
							<div class="topnav" id="myTopnav">
								<a href="../index.php">Live Cams</a>
								<a href="../login_member.php">Get Tokens</a>
								<a href="model.php">Broadcast yourself</a>
								<a href="../login_member.php">Member Login</a>
								<a href="../broadcaster.php">Broadcast Login</a>


								<a href="user.php" id="join-button" style="opacity:1.0; margin-left: 10px;"> Join Now for FREE</a>

								<li class="dropdown">
									<a class="dropdown-toggle sdfdf" data-toggle="dropdown" href="#">login<span class="caret"></span></a>
									<ul class="jflkjdfl">
										<li><a href="broadcaster.php">Broadcast</a></li>
										<li><a href="login_member.php">Member</a></li>
									</ul>
								</li>

								<a href="javascript:void(0);" style="font-size:15px;" class="icon" onClick="myFunction()">&#9776;</a>
							</div>
						</ul>
					</td>
				</tr>
			</div>
		</nav>
		<div class="bgsgsgcls">
			<div class="col-md-l2 hide-on-med-and-down dfdf">
				<div class="collection">
					<?php

					function url()
					{
						if (isset($_SERVER['HTTPS'])) {
							$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
						} else {
							$protocol = 'http';
						}
						return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					}

					foreach ($cat_array_top as $cat_top) {
						foreach ($cat_top as $c) {
							$dbcat_top = base64_encode($c);
							$getcat_top = base64_decode($_GET['category_top']);
							if ($getcat_top == $c) {
								echo '<a href="../category.php?category=' . $dbcat_top . '" class="collection-item second-nv-active">' . $c . '</a>';
							} else if (($getcat_top == "") and (url() == "http://m.buildsite1.info") and ($c == "Featured")) {
								echo '<a href="../category.php?category=' . $dbcat_top . '" class="collection-item second-nv-active">' . $c . '</a>';
							} else {
								echo '<a href="../category.php?category=' . $dbcat_top . '" class="collection-item">' . $c . '</a>';
							}
						}
					}
					?>
				</div>
			</div>
		</div>


		<div class="mobile-menu transparent-bac_colour">

			<div class="top-mob-header" style="background-color:#<?php echo $topBarColor1 ?> !important;">
				<div class="toggle-btn">

					<span class="tog-bor"></span>
					<span class="tog-bor"></span>
					<span class="tog-bor"></span>

				</div>



				<div class="mob-logo"><a href="<?php echo $siteurl ?>"><img src="../images/logo.png"></a></div>
			</div>

			<div class="toggle-mob-menu">
				<div class="join-button"><a href="user.php" class="active" id="join-button">Join Now for FREE</a></div>
				<div class="main-drop-sec mob-menu-category">
					<h3 class="drop-menu-mob" style="font-size:16px !important;">categories <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
					<div class="collection-mob drop-data-mob">



						<?php
						foreach ($cat_array as $cat) {
							foreach ($cat as $c) {
								$dbcat = base64_encode($c);
								$getcat = base64_decode($_GET['category']);
								if ($getcat == $c) {
									echo '<a href="../category.php?category=' . $dbcat . '" class="collection-item second-nv-active">' . $c . '</a>';
								} else if (($getcat == "") and (url()) and ($c == "Featured")) {
									echo '<a href="../category.php?category=' . $dbcat . '" class="collection-item second-nv-active">' . $c . '</a>';
								} else {
									echo '<a href="../category.php?category=' . $dbcat . '" class="collection-item">' . $c . '</a>';
								}
							}
						}
						?>
					</div>
				</div>

				<ul class="mob-menu-dest">


					<li><a href="../login_member.php">Get Tokens</a></li>
					<li><a href="model.php">Broadcast Yourself</a></li>
					<li class="main-drop-sec login-drop">
						<h3 class="drop-menu-mob" style="font-size:16px !important;">Login <i class="fa fa-angle-down" aria-hidden="true"></i></h3>
						<div class="collection-mob drop-data-mob">
							<a href="../broadcaster.php" class="collection-item">Broadcast</a>
							<a href="../login_member.php" class="collection-item">Member</a>
						</div>
					</li>
					<li class="main-drop-seclogin-drop">
					</li>
					<li class="main-drop-seclogin-drop">
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col l2 hide-on-med-and-down">
		<div class="bar2" height="35px">
			<a href="<?php echo $siteurl ?>/new/matcss.php#">
				<div class="model-button" align="right">
					<div align="center">MODEL SIGNUP</div>
				</div>
			</a>
		</div>
	</div>
	<div class="topbore"></div>
	<div class="row"></div>
	<div class="row bac_colour">