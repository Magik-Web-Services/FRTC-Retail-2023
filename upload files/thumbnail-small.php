<?php

include("dbase.php");

include("settings.php");

$result = mysqli_query($conn, "SELECT user from chatusers WHERE id='$_COOKIE[id]' LIMIT 1");

while ($row = mysqli_fetch_array($result)) {
	$username = $row['user'];
}


?>

<script>
	$(".myBox").click(function() {
		window.location = $(this).find("a").attr("href");
		return false;
	});
</script>

<style>
	body {
		margin-left: 0px;
		margin-top: 0px;
	}
</style>
<?php

if (isset($_COOKIE['usertype']) && $_COOKIE['usertype'] == "chatusers") {
	$result = mysqli_query($conn, 'SELECT cpm FROM chatmodels WHERE user="' . $_GET['model'] . '" LIMIT 1');

	while ($row = mysqli_fetch_array($result)) {
		$cpm = $row['cpm'];
	};

	$result = mysqli_query($conn, 'SELECT id,user,money,freetime,freetimeexpired FROM chatusers WHERE id="' . $_COOKIE['id'] . '" LIMIT 1');

	while ($row = mysqli_fetch_array($result)) {

		$freetime = $row['freetime'];

		$freetimeexpired = $row['freetimeexpired'];

		$sUser = $row['user'];

		$sId = $row['id'];

		$nMoney = $row['money'];
	}



	if ($freetime == 0 && (time() - $freetimeexpired) > (3600 * $freehours)) {

		mysqli_query($conn, "UPDATE chatusers SET freetime='120', freetimeexpired='0' WHERE id='$_COOKIE[id]' LIMIT 1");

		$freetime = 110;
	}

	$result = mysqli_query($conn, "SELECT * from favorites WHERE member='$sUser' AND model='$_GET[model]'");

	if (mysqli_num_rows($result) >= 1) {
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
<embed flashvars="&fuser=<?php echo $sUser; ?>&fmodel=<?php echo $_GET['model']; ?>&fid=<?php echo $sId; ?>&fmoney=<?php echo $nMoney; ?>&favorite=<?php echo $nFav; ?>&freetime=<?php echo $freetime; ?>&connection=<?php echo $connection_string; ?>&cpm=<?php echo $cpm; ?>" src="thumbnail.swf" width="217" height="174" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>