<?php
$member_name = "";
if (!isset($_COOKIE["id"]) || $_COOKIE['usertype'] != "chatmodels") {
	header("location: ../../login.php");
} else {

	include("../../dbase.php");

	$result = mysqli_query($conn, "SELECT user from $_COOKIE[usertype] WHERE id='$_COOKIE[id]' LIMIT 1");



	while ($row = mysqli_fetch_array($result)) {
		$username = $row['user'];
	}
}

mysqli_free_result($result);



$msgError = "";

include("../../dbase.php");

$id = $_COOKIE["id"];

$model = $username;



if (isset($_POST['paymentSum'])) {

	mysqli_query($conn, "UPDATE chatmodelsstatus SET minimum='$_POST[paymentSum]' WHERE id = '$id' LIMIT 1");

	$msgError = "Value has been changed";
}

include("_models.header.php");
?><style type="text/css">
	body,
	td,
	th {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
		color: #000;
	}

	table {
		margin: auto;
		border: 1px solid;

	}

	.mainmydiv {
		width: 90%;
		margin: 0 auto;
		margin-top: 30px;
	}

	.mymaindiv {
		background-color: #eeee;
		box-shadow: 1px 1px 3px #999;
		margin: 0px 0 29px;
		float: left;
		width: 100%;
		padding: 25px;
	}

	.form_definitions {
		padding-left: 55px;
	}

	#css3menu1 .topmenu a {
		margin-bottom: 35px;
	}

	tr:nth-of-type(odd) {
		background: #eee;
	}

	th {
		background: #000;
		color: white;
		font-weight: bold;
	}

	td,
	th {
		padding: 6px;
		border: 1px solid #000;
		text-align: center;
	}

	tr {
		border-bottom: 1px solid;
	}

	@media(device-width: 768px) {
		::-webkit-scrollbar {
			-webkit-appearance: none;
			width: 7px;
		}

		::-webkit-scrollbar-thumb {
			border-radius: 4px;
			background-color: #05b0fa;
			-webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
		}
	}
</style>
<?php


$result22 = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$model' ORDER BY date DESC");
//$result22 = mysql_query("SELECT * FROM videosessions");
$num_rows = mysqli_num_rows($result22);

//echo $num_rows;
if ($num_rows > 11) {
?>
	<style>
		.newmain {
			overflow: scroll;
			height: 400px;
		}
	</style>
<?php } else { ?>
	<style>
		.newmain {
			overflow: scroll;
			height: auto;
		}
	</style>
<?php } ?>

<div class="mainmydiv">
	<div class="mymaindiv">
		<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
			<ul id="css3menu1" class="topmenu">
				<div>
					<li class="topmenu"><a href="paymentop.php">
							<div style="color:#FFFFFF !important">View Payments</div>
						</a></li>

					<li class="topmenu"><a href="showslist.php">
							<div style="color:#FFFFFF !important">View Show History</div>
						</a></li>
				</div>
			</ul>
		</table>
		<div class="tip-sections">
			<?php
			$relt22 = mysqli_query($conn, "SELECT SUM(cpm), MAX(cpm) FROM videosessions WHERE model='$model' ORDER BY date DESC");
			//$result22 = mysql_query("SELECT * FROM videosessions");
			$row12122 = mysqli_fetch_array($relt22);
			//echo "<pre>"; print_r($row12122); echo "</pre>";
			$total_tip = $row12122['SUM(cpm)'];
			$max_tip = $row12122['MAX(cpm)'];
			$relt12202 = mysqli_query($conn, "SELECT cpm as cptoken, member as latst_tokn_mmbr_nm FROM videosessions WHERE model='$model' ORDER BY date DESC");
			$row1210022 = mysqli_fetch_array($relt12202);
			//echo "<pre>"; print_r($row1210022['latst_tokn_mmbr_nm']); echo "</pre>";
			$latest_tip = isset($row1210022['cptoken']);
			$latest_tip_member = isset($row1210022['latst_tokn_mmbr_nm']);
			$relt220 = mysqli_query($conn, "SELECT member FROM videosessions WHERE cpm='$max_tip' ORDER BY date DESC LIMIT 1");
			while ($row121220 = mysqli_fetch_array($relt220)) {
				$member_name = isset($row121220['member']);
			}

			?>
			<ul>
				<li>
					<strong>Tip Received/Goal: </strong>
					<span><?php echo $total_tip; ?>/10000 </span>
				</li>
				<li>
					<strong>Highest Tip: </strong>
					<span><?php echo $member_name;
							echo " (" . $max_tip . ")"; ?></span>
				</li>
				<li>
					<strong>Latest Tip Received: </strong>
					<span><?php echo $latest_tip_member;
							echo " (" . $latest_tip . ")"; ?></span>
				</li>
			</ul>
		</div>
		<div class="newmain">
			<div class="newmain_sub">

				<ul>
					<li class="heading">Member</li>
					<li class="heading">Date</li>
					<li class="heading">Length</li>
					<li class="heading">CPM</li>
					<li class="heading">Percentage</li>
					<li class="heading">Earned</li>
					<li class="heading">Paid</li>
					<li class="heading">Type</li>
					<?php
					include('../../dbase.php');
					$count = 0;
					$result = mysqli_query($conn, "SELECT * FROM videosessions WHERE model='$model' ORDER BY date DESC");
					//$result = mysql_query("SELECT * FROM videosessions");
					while ($row = mysqli_fetch_array($result)) {

						$count++;

						$ammount = $row['ammount'];

						$member = $row['member'];

						$epercentage = $row['epercentage'];

						$duration = $row['duration'];

						$cpm = $row['cpm'];

						$type = $row['type'];

						if (($duration / 60) < round($duration / 60)) {

							$tempMinutesPv = round($duration / 60) - 1;
						} else {

							$tempMinutesPv = $duration / 60;
						}

						$tempSecondsPv = $duration % 60;

						if ($type == 'show') {
							$ammount = floor((($duration / 60) * $cpm) * ($epercentage / 100));
						}
						if ($type == 'tip') {
							$ammount = floor(($cpm) * ($epercentage / 100));
						}

						if ($row['paid'] != "1") {
							$paied = "no";
						} else {
							$paied = "yes";
						}

						echo '<li>' . $member . '</li>

							<li>' . date("d M Y, G:i:s", $row['date']) . '</li>

							<li>' . ($type == 'tip' ? "NA" : $tempMinutesPv . ":" . $tempSecondsPv) . '</li>

							<li>' . $cpm . ' Tokens</li>

							<li>' . $epercentage . '%</li>

							<li>$' . $ammount . '</li>

							<li>' . $paied . '</li>

							<li>' . $type . '</li>';
					}
					mysqli_free_result($result);
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php include("_models.footer.php"); ?>