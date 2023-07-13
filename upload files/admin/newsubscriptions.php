<?php
include("_header-admin.php");
include('../dbase.php');
include('../settings.php');
$color = "";
?>
<?php
if (isset($_POST['reject'])) {
	$result2 = mysqli_query($conn, "SELECT * FROM chatmodels WHERE status='pending'");
	while ($row2 = mysqli_fetch_array($result2)) {
		mysqli_query($conn, 'DELETE from modelpictures WHERE user="' . $_row2['user'] . '"');
		mysqli_query($conn, 'DELETE from chatmodels WHERE user="' . $row2['user'] . '"');
		mysqli_query($conn, 'DELETE from favorites WHERE model="' . $row2['user'] . '"');

		$dir = "../models/" . $row2['user'] . "/";
		$files = scandir($dir);
		foreach ($files as $file) {
			if (strlen($file) > 2) {
				unlink($dir . $file);
			}
		}
		rmdir($dir);

		mail(
			$row2['email'],
			"Your submission at $siteurl was rejected",
			"your registration has been denied",
			"MIME-Version: 1.0\r\n" .
				"Content-type: text/plain; charset=iso-8859-1\r\n" .
				"From:$registrationemail\r\n" .
				"Reply-To?:$registrationemail\r\n" .
				"X-Mailer: PHP/" . phpversion()
		);
	}
}
?>
<style type="text/css">
	<!--
	body {
		margin-top: -16px !important;


	}

	.selector {
		background-image: url();
		background-color: #FFFFFF;

		position: fixed;

		top: 0;
		left: 0;
		width: 100%;
		height: 50px;
		z-index: 10;

	}

	td {
		padding: 2px 0;
	}

	/*
.form_definitions{
    background-color:#ddd;
	color:#fff;
	border:solid;
	border-width:0.5px;
	border-color:#ccc;
	border-radius:4px;
	padding:8px !important;
    margin-bottom:2px;


}
*/




	.form_definitions {
		background-color: #ececec;
		color: #fff;
		border: solid;
		border-width: 0.5px;
		border-color: #ccc;
		border-radius: 4px;
		padding: 8px !important;
		margin-bottom: 2px;


	}



	.buttonCSS {
		border: solid;
		border-width: 0.5px;
		border-color: #CCCCCC;
		background-color: #3399FF;
		border-radius: 4px;
		width: 100px;
		height: 20px;
		padding: 5px;
		color: #fff;


	}
	-->

</style>

<body>

	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h1 align="center" class="style1">Pending Broadcasters</h1>
	<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" style="margin-top:0px;">
		<tr>
			<td>
				<form action="" method="post"><input type="hidden" name="reject" value="1" /><input type="submit" value="Reject all" style="width:175px;background-color:#ff0000;color:#fff;cursor:pointer;padding:5px;margin-top:50px;"></form>
			</td>
		</tr>
		<tr>
			<td>
				<div align="center">
					<?php

					//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
					//$secondsAll=time();





					echo '<table class="form_definitions" width="1010" bgcolor="" border="0" align="left" cellpadding="0" cellspacing="0">';
					$result2 = mysqli_query($conn, "SELECT * FROM chatmodels WHERE status='pending'");
					while ($row2 = mysqli_fetch_array($result2)) {
						$tempCity = $row2['city'];
						$result3 = mysqli_query($conn, "SELECT name FROM countries WHERE id='$row2[country]' LIMIT 1");
						while ($row3 = mysqli_fetch_array($result3)) {
							$sName = $row3['name'];
						}
						if ($color == "#ffffff") {
							$color = "#ffffff";
						} else {
							$color = "#ffffff";
						}

						echo '<tr class="form_definitions" style="background-color:#fff"margin-bottom:20px !important;><td width="105px"><img src="../models/' . $row2['user'] . '/thumbnail.jpg" width="100px" height="75px"></td><td align="center"><b>' . $row2['user'] . '</b></td><td align="center">' . $sName . '</td><td align="center"><a href="mailto:' . $row2['email'] . '">' . $row2['email'] . '</td><td align="center"><a href="subscriptionviewdetails.php?id=' . $row2['id'] . '"><div class="buttonCSS">View Details</div></a></td></tr><tr style="background-color:#000;height:2px;"></tr>';
					}



					echo '</table>';

					?>

				</div>
			</td>
		</tr>
	</table><br>


</body>
<?php
include("_footer-admin.php")
?>