<?php
include("../dbase.php");
include("_header-admin.php");
$PHP_SELF = "";
$sitemoney30 = "";
$color = "";
?>


<style type="text/css">
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



	textarea {
		font-size: 12pt;
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-weight: bold;

	}





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

	body {
		margin-top: -16px !important;


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



	.pageNumbers {
		border: solid;
		border-width: 0.5px;
		border-color: #CCCCCC;
		background-color: #3399FF;
		border-radius: 4px;
		width: 20px;
		height: 20px;
		padding: 5px;
		color: #fff;
		text-align: center;
		cursor: pointer;
		white-space: nowrap;
		display: inline-block;
	}


	.pageNumbers:hover {
		border: solid;
		border-width: 0.5px;
		border-color: #CCCCCC;
		background-color: #99CC00;
		border-radius: 4px;
		width: 20px;
		height: 20px;
		padding: 5px;
		color: #fff;
		text-align: center;
		cursor: pointer;
	}
</style>





<?php
include('../dbase.php');
if (isset($_POST['submit'])) {
	$val = $_POST['welcome'];
	echo $val;
	$insertQuery = "UPDATE  welcome set models ='$val' where 1";
	$conn1 = mysqli_query($conn, $insertQuery);
	if ($conn1) {
		echo "<script>alert('The data was saved successfully .');</script>";
	}
}

$welcomeQuery = "SELECT models FROM welcome";
$result = mysqli_query($conn, $welcomeQuery);
$chkN = mysqli_num_rows($result);
if ($chkN > 0) {
	$valueW = $result->fetch_assoc()['blah'] ?? false;
} else {
	$valueW = "Please write something";
}

?>


<?php
include("../dbase.php");
include("../settings.php");
$tempMinutesPv = 0;
$tempSecondsPv = 0;
$sitemoney = 0;
$tempMoneyEarned = 0;
$tempMoneySent = 0;
$tempMoneyEarned30 = 0;
$ammount = 0;
$result = mysqli_query($conn, "SELECT * FROM videosessions ");
while ($row = mysqli_fetch_array($result)) {
	$member = $row['member'];
	$epercentage = $row['epercentage'];
	$duration = $row['duration'];
	$cpm = $row['cpm'];
	$tempSecondsPv += $row['duration'];
	if ($row['type'] == 'show') {
		$ammount = ((($duration / 60) * $cpm) * ($epercentage / 100));
		$ammount2 = ((($duration / 60) * $cpm) * ((100 - $epercentage) / 100));
		$tempMoneyEarned += $ammount;
		$sitemoney += $ammount2;
	}
	if ($row['type'] == 'tip') {
		$ammount = ($cpm * ($epercentage / 100));
		$ammount2 = ($cpm * ((100 - $epercentage) / 100));
		$tempMoneyEarned += $ammount;
		$sitemoney += $ammount2;
	}

	if (time() - 604800 < $row['date']) {
		$tempMoneyEarned30 += $ammount;
		$sitemoney30 += $ammount2;
	}
	if ($row['paid'] == "1") {
		$tempMoneySent += $ammount;
	}
}
mysqli_free_result($result);
?>
<p>


	<script>
		function textCounter(field, field2, maxlimit) {
			var countfield = document.getElementById(field2);
			if (field.value.length > maxlimit) {
				field.value = field.value.substring(0, maxlimit);
				return false;
			} else {
				countfield.value = maxlimit - field.value.length;
			}
		}
	</script>





</p>




<table width="1010" border="0" align="center" cellpadding="10" cellspacing="1" bgcolor="#F8F8F8">



	<br>
	<br>
	<br>
	<br>
	<tr>
		<td align="center">
			<h1 style="margin-bottom:-20px;margin-top:-10px;">All Registered Broadcasters</h1>
		</td>
	</tr>




	<tr>
		<td align="center">

			<p>&nbsp;</p>

			<h3 style="margin-bottom:-20px;margin-top:-10px;">Enter Broadcaster Welcome Message</h3>
		</td>
	</tr>


	<form method="post" action="<?php echo $PHP_SELF ?>">
		<td align="center">

			<p>
				<textarea onkeyup="textCounter(this,'counter',1200);" name="welcome" style="width:900px; height:300px; color:#555">
	</textarea>
			</p>
			<p>
				<input disabled maxlength="6" size="6" value="1200" id="counter" style="width:20% !important;background-color:#FFF !important;cursor:pointer;" />


			</p>
		</td>
		</tr>
		<tr>
			<td align="center" valign="middle">
				<input type="submit" name="submit" value="Save" style="width:20% !important;background-color:#ddd !important;cursor:pointer;margin-top:-30px;margin-bottom:40px;" />
			</td>
	</form>
	</tr>





	<tr>
		<td align="center">

			<h2 style="margin-bottom:-20px;">Search Broadcasters</h2>
		</td>
	</tr>
	<tr>
		<form method="post" action="<?php echo $PHP_SELF ?>">
			<td align="center">
				<input type="text" name="srn" value="" placeholder="Enter broadcaster name..." style="width:300px;" />
			</td>
	</tr>
	<tr>
		<td align="center" valign="middle">
			<input type="submit" name="search" value="Search" style="width:20% !important;background-color:#ddd !important;cursor:pointer;" />
		</td>
		</form>
	</tr>

</table>
</td>
</tr>
<tr>
	<td bgcolor=" #F8F8F8" class="small_title">
		<p class="message"><strong>Broadcaster funds earned total: $<?php echo $tempMoneyEarned; ?><br>
				Site funds earned from Broadcasters total: $<?php echo $sitemoney; ?> <br>
				Unpaid Broadcaster funds total: $<?php echo $tempMoneyEarned - $tempMoneySent ?><br>
				Site funds earned from Broadcasters total (last 7 days): $<?php echo $sitemoney30; ?></strong></p>
	</td>
</tr>
</table>

<div align="center">
	<table width="1010" border="0" cellpadding="10">
		<tr>
			<td>
				<div class="pages" align="right"></div>
			</td>
		</tr>
	</table>
</div>
<table width="1010" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
	<tr>
		<td bgcolor="#ffffff">
			<br>
			<table width="1010" bgcolor="#ffffff" border="0" align="center" cellpadding="1" cellspacing="1">
				<?php

				//$secondsThisMonth=time(i)*60+time(G)*3600+time(j)*86400
				//$secondsAll=time();




				$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE status!='pending' AND status!='rejected'");


				$total = mysqli_num_rows($result);
				$perpage = 35;
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				} else {
					$page = 1;
				}
				$start = ($page - 1) * $perpage;
				$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE status!='pending' AND status!='rejected' LIMIT $start,$perpage");
				if (isset($_POST['srn'])) {
					$result = mysqli_query($conn, "SELECT * FROM chatmodels WHERE user like '%$_POST[srn]%' OR email='$_POST[srn]' ");
				}


				while ($row2 = mysqli_fetch_array($result)) {
					$result3 = mysqli_query($conn, "SELECT name FROM countries WHERE id='$row2[country]' LIMIT 1");
					while ($row3 = mysqli_fetch_array($result3)) {
						$tempCountry = $row3['name'];
					}

					$tempCity = $row2['city'];

					if ($color == "#ffffff") {
						$color = "#ffffff";
					} else {
						$color = "#ffffff";
					}
					echo '<tr padding="20px" bgcolor="' . $color . '" class="form_definitions"><td width="105px"><img src="../models/' . $row2['user'] . '/thumbnail.jpg" width="100px" height="65px"></td><td align="center"><b>' . $row2['user'] . '</b></td><td align="center">' . $tempCountry . '</td><td align="center">' . $row2['email'] . '</td><td align="center"><a href="modelviewdetails.php?id=' . $row2['id'] . '"><div class="buttonCSS">View Details</div></a></td></tr>';
				}


				if (isset($_POST['srn'])) {
					if ($total) {
						$pages = range(1, ceil($total / $perpage));
						echo "<tr><td>";
						foreach ($pages as $pagez) {
							if ($pagez == $page) {
								echo "<div class='pageNumbers'><b> $pagez</b></div>";
								echo  " ";
							} else {
								echo "<a href=\"models.php?page=$pagez\"><div class='pageNumbers'><b>$pagez</b></div></a>";
								echo  " ";
							}
						}
						echo "</td></tr>";
					}
				}

				?>








			</table>
			<br>
		</td>
	</tr>
</table>
<div align="center">
	<table width="1010" border="0">
		<tr>
			<td></td>
		</tr>
	</table>
	<?php
	include("_footer-admin.php")
	?>
</div>