<?php

include("settings.php");

?>

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<head>


	<meta property=og:image content="<? echo $siteurl ?>og-img.jpg">

	<meta name="description" content="<? echo $sitename ?>">

	<!-- Facebook Meta Tags -->
	<meta property="og:url" content="<? echo $siteurl; ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<? echo $sitename ?>">
	<meta property="og:description" content="<? echo $sitename ?>">
	<meta property=og:image content="<? echo $siteurl ?>og-img.jpg">

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:domain" content="<? echo $siteurl ?>">
	<meta property="twitter:url" content="<? echo $siteurl; ?>">
	<meta name="twitter:title" content="<? echo $sitename ?>">
	<meta name="twitter:image" content="<? echo $siteurl ?>og-img.jpg">
	<meta name="twitter:description" content="<? echo $sitename ?>">

</head>
<html lang="en">

<head>



	<?php



	include("dbase.php");



	include("settings.php");

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





	<!--  Top Bar Menu PHP code    -->

	<?php



	$query = mysqli_query($conn, "select * from category_top order by id asc");



	while ($row = mysqli_fetch_object($query)) {



		$cats_top[] = $row->name;
	}



	$cat_array_top = array_chunk($cats_top, 7);



	$columns_top = count($cat_array_top);



	?>



	<!-- Top Bar Menu PHP code   -->






	<title><?php echo $sitename; ?></title>







	<!-- CSS  -->



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



	<link href="cssnhd/bootstrap.css" type="text/css" rel="stylesheet">



	<link href="cssnhd/style.css" type="text/css" rel="stylesheet">



	<link href="font-awesomenhd/css/font-awesome.min.css" rel="stylesheet" type="text/css">



	<link href="cssnhd/media.css" type="text/css" rel="stylesheet">



	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />



	<link rel="stylesheet" type="text/css" href="css2/grid-2.css" />



	<style>
		body {
			margin: 0;
			background-image: inherit !important;
			font-weight: normal !important;
			font-size: 14px !important;
			background-color: <?php echo "#" . $mainSiteBackgroundColor ?> !important;
		}











		.topnav {
			background-color: transparent;
			/* width: 100%; */
			align-items: right;
			float: right;
			margin-right: 1px;
		}











		/* Top Nav Bar Buttons */







		.topnav a {
			border: 1px solid <?php echo '#' . $TopButtonOutlineColor ?>;
			border-radius: 4px;
			background-color: <?php echo '#' . $TopButton ?>;
			color: <?php echo '#' . $TopButtonText ?>;
			display: block;
			float: left;
			font-size: 14px !important;
			padding: 4px 7px;
			text-align: center;
			text-decoration: none;
			text-transform: capitalize;
			margin-left: 3px;
		}



















		.topnav a:hover {
			background-color: #<?php echo $TopButtonHover ?>;
			color: #<?php echo $TopButtonTextHover ?>;
			border: 1px solid #<?php echo $TopButtonHoverOutlineColor ?>;
			border-radius: 4px;
		}







		.active {



			background-color: #<?php echo $TopButtonActive ?>;



			color: #<?php echo $TopButtonTextActive ?> !important;



			border: 1px solid #<? echo $TopButtonActiveOutlineColor ?>;



			border-radius: 4px;
			opacity: 1;
		}

		.active:hover {



			opacity: 0.9;















		}



















		.topnav .icon {



			display: none;



		}











		/* Bottom header bar opacity  */







		.bgsgsgcls.fixed-headr {



			width: 100%;



			z-index: 999;



			background-color: #000;



			opacity: 1.0;







		}























		.after_login_section ul.jflkjdfl {



			z-index: 99999999;



		}







		/*center header break - padding adjusts the spacing*/







		.bgsgsgcls {



			float: left;



			width: 100%;



			padding-top: 0px;



			transition: all 300ms ease;



		}



		.myanothercss {



			margin: 30px 0 0;



			float: left;



			width: 100%;



		}











		/* Newer VAR CSS */











		/* Top Bar Color */







		.pinkcs {



			/*  background-color: #<? echo $topBarColor1 ?>; */

			background-image: linear-gradient(#<?php echo $topBarColor1 ?>, #<? echo $topBarColor2 ?>) !important;

			float: left;



			padding: 4px 0;



			width: 100%;

			height: 55px;
			opacity: 96% !important;





			/* Top bar opacity */







			opacity: 1.0;















		}











		/* Top Bar 2 Color  */







		.col-md-l2.hide-on-med-and-down {



			padding: 10px 26px 13px;



			background: #<? echo $topBarColor2 ?>;


			display: none;






		}











		.phone-header {



			color: #<? echo $scrollTextColor ?>;



			padding: 12px 33px !important
		}







































		@media screen and (max-width: 600px) {



			.topnav a:not(:first-child) {
				display: none;
			}



			.topnav a.icon {



				float: right;



				display: block;



			}





		}







		@media screen and (max-width: 600px) {



			.topnav.responsive {
				position: relative;







			}











			.topnav.responsive .icon {



				position: absolute;



				right: 0;



				top: 0;



			}







			.topnav.responsive a {



				float: none;



				display: block;



				text-align: left;



			}







			.open>.dropdown-menu
		}











		/* pretty yellow button */

		#join-button {

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

			padding: 0 19px;

			text-align: center;

			text-decoration: none;

			text-shadow: 0 1px hsla(0, 0%, 100%, .4);



		}







		#join-button:hover {

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

			padding: 0 19px;

			text-align: center;

			text-decoration: none;

			text-shadow: 0 1px hsla(0, 0%, 100%, .4);



		}







		/* pretty yellow button */

		#join-button-mobile {

			background: #fc0;

			background: linear-gradient(180deg, #fc0, #f98706);

			border: 0;

			border-radius: 2px;

			box-shadow: 0 1px 0 rgba(0, 0, 0, .3);

			color: #441f00 !important;

			cursor: pointer;

			display: inline-block;

			font: 700 14px/40px arial, sans-serif;

			height: 40px;

			margin: 0;

			outline: none;

			padding: 0 19px;

			text-align: center;

			text-decoration: none;

			text-shadow: 0 1px hsla(0, 0%, 100%, .4);



		}







		#join-button-mobile:hover {

			background: #fc0;

			background: linear-gradient(180deg, #ffd429, #f98706);

			border: 0;

			border-radius: 2px;

			box-shadow: 0 1px 0 rgba(0, 0, 0, .3);

			color: #441f00 !important;

			cursor: pointer;

			display: inline-block;

			font: 700 14px/40px arial, sans-serif;

			height: 40px;

			margin: 0;

			outline: none;

			padding: 0 19px;

			text-align: center;

			text-decoration: none;

			text-shadow: 0 1px hsla(0, 0%, 100%, .4);



		}
	</style>



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



















	<link rel="stylesheet" type="text/css" href="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.css" />
	<script src="https://cdn.wpcc.io/lib/1.0.2/cookieconsent.min.js" defer></script>
	<script>
		window.addEventListener("load", function() {
			window.wpcc.init({
				"border": "thin",
				"corners": "small",
				"transparency": "5%",
				"colors": {
					"popup": {
						"background": "#111111",
						"text": "#ffffff",
						"border": "#222222"
					},
					"button": {
						"background": "#FFFFFF",
						"text": "#000000"
					}
				},
				"position": "bottom"
			})
		});
	</script>



















</head>



<body>







	<div class="navbar-fixed">



		<nav class="pinkcs desktopmenu" role="navigation">



			<div class="nav-wrapper">



				<tr>



					<td class="top-right-td" valign="top"><!-- Start css3menu.com BODY section -->



						<ul id="css3menu1" class="topmenu headermaintopleft">



							<li class="topmenu col-md-2 col-sm-6">
								<center><a href="<?php echo $siteurl ?>"><img src="images/logo1.png"></a></center>
							</li>







						</ul>



						<!--<div class="phone-header col-md-4 col-sm-12"> <? echo $headerLabel ?> <marquee scrolldelay="<? echo $scrollingSpeed ?>"> <? echo $scrollText ?> </marquee></div>-->



					</td>



					<td class="top-left-td" valign="top" align="right"><!-- Start css3menu.com BODY section -->



						<ul id="css3menu2" class="col-md-5 col-sm-12 topmenu hhhhhff">



							<div class="topnav" id="myTopnav">





								<a href="index.php"><i class="fas fa-video"></i>&nbsp;Live Cams</a>







								<a href="login_member.php"><i class="fas fa-donate"></i>&nbsp;Get Tokens</a>



								<a href="registration/model.php">Broadcast yourself</a>



								<a href="login_member.php">Member Login</a>



								<a href="broadcaster.php">Broadcast Login</a>




								<a href="registration/user.php" id="join-button" style="opacity:1.0; margin-left: 10px;"> Join Now for FREE</a>















								<!--



							  <li class="dropdown">



							  <a class="dropdown-toggle sdfdf" data-toggle="dropdown" href="#">login<span class="caret"></span></a>



							  <ul class="jflkjdfl">



							  <li><a href="broadcaster.php">Broadcast</a></li>



							  <li><a href="login_member.php">Member</a></li>



							  </ul>



							  </li>



						-->







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



								echo '<a href="category.php?category=' . $dbcat_top . '" class="collection-item second-nv-active">' . $c . '</a>';
							} else if (($getcat_top == "") and (url() == "http://update.buildsite2.info") and ($c == "Featured")) {



								echo '<a href="category.php?category=' . $dbcat_top . '" class="collection-item second-nv-active">' . $c . '</a>';
							} else {



								echo '<a href="category.php?category=' . $dbcat_top . '" class="collection-item">' . $c . '</a>';
							}
						}
					}



					?>



				</div>



			</div>



		</div>



		<div class="mobile-menu transparent-bac_colour">



			<div class="top-mob-header" style="background-color:#<? echo $topBarColor1 ?> !important;">



				<div class="toggle-btn">



					<span class="tog-bor"></span>



					<span class="tog-bor"></span>



					<span class="tog-bor"></span>



				</div>



				<div class="mob-logo"><a href="<?php echo $siteurl ?>"><img src="images/logo1.png"></a></div>



			</div>



			<div class="toggle-mob-menu">



				<div class="login-btn"><a href="registration/user.php" id="join-button-mobile"> Join Now for FREE</a></div>



				<div class="main-drop-sec mob-menu-category">



					<h3 class="drop-menu-mob" style="font-size:16px !important;">categories <i class="fa fa-angle-down" aria-hidden="true"></i></h3>



					<div class="collection-mob drop-data-mob">



						<?php



						foreach ($cat_array as $cat) {



							foreach ($cat as $c) {



								$dbcat = base64_encode($c);



								$getcat = base64_decode($_GET['category']);



								if ($getcat == $c) {



									echo '<a href="category.php?category=' . $dbcat . '" class="collection-item second-nv-active">' . $c . '</a>';
								} else if (($getcat == "") and (url()) and ($c == "Featured")) {



									echo '<a href="category.php?category=' . $dbcat . '" class="collection-item second-nv-active">' . $c . '</a>';
								} else {



									echo '<a href="category.php?category=' . $dbcat . '" class="collection-item">' . $c . '</a>';
								}
							}
						}



						?>



					</div>



				</div>







				<ul class="mob-menu-dest">











					<li><a href="login_member.php">Get Tokens</a></li>



					<li><a href="registration/model.php">Broadcast Yourself</a></li>



					<li class="main-drop-sec login-drop">



						<h3 class="drop-menu-mob" style="font-size:16px !important;">Login <i class="fa fa-angle-down" aria-hidden="true"></i></h3>



						<div class="collection-mob drop-data-mob">



							<a href="broadcaster.php" class="collection-item">Broadcast</a>



							<a href="login_member.php" class="collection-item">Member</a>



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



			<a href="<? echo $siteurl ?>/new/matcss.php#">



				<div class="model-button" align="right">



					<div align="center">MODEL SIGNUP</div>



				</div>



			</a>



		</div>



	</div>



	<div class="topbore"></div>



	<div class="row"></div>



	<div class="row bac_colour">